<?php


namespace Modules\Directory\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseModelApi extends Model
{
    protected $model;
    protected $fields;
    protected $request;
    protected $take_default=5;


    function __construct(Request $request, $model, $fields = [])
    {
        $this->model= $model;
        $this->fields = $fields;
        $this->request=$request;
    }
//    -----------------------------------
    private function Escape_win($path)
    {
        $path = strtoupper($path);
        return strtr($path, array("\U0430" => "а", "\U0431" => "б", "\U0432" => "в",
            "\U0433" => "г", "\U0434" => "д", "\U0435" => "е", "\U0451" => "ё", "\U0436" => "ж", "\U0437" => "з", "\U0438" => "и",
            "\U0439" => "й", "\U043A" => "к", "\U043B" => "л", "\U043C" => "м", "\U043D" => "н", "\U043E" => "о", "\U043F" => "п",
            "\U0440" => "р", "\U0441" => "с", "\U0442" => "т", "\U0443" => "у", "\U0444" => "ф", "\U0445" => "х", "\U0446" => "ц",
            "\U0447" => "ч", "\U0448" => "ш", "\U0449" => "щ", "\U044A" => "ъ", "\U044B" => "ы", "\U044C" => "ь", "\U044D" => "э",
            "\U044E" => "ю", "\U044F" => "я", "\U0410" => "А", "\U0411" => "Б", "\U0412" => "В", "\U0413" => "Г", "\U0414" => "Д",
            "\U0415" => "Е", "\U0401" => "Ё", "\U0416" => "Ж", "\U0417" => "З", "\U0418" => "И", "\U0419" => "Й", "\U041A" => "К",
            "\U041B" => "Л", "\U041C" => "М", "\U041D" => "Н", "\U041E" => "О", "\U041F" => "П", "\U0420" => "Р", "\U0421" => "С",
            "\U0422" => "Т", "\U0423" => "У", "\U0424" => "Ф", "\U0425" => "Х", "\U0426" => "Ц", "\U0427" => "Ч", "\U0428" => "Ш",
            "\U0429" => "Щ", "\U042A" => "Ъ", "\U042B" => "Ы", "\U042C" => "Ь", "\U042D" => "Э", "\U042E" => "Ю", "\U042F" => "Я"));
    }

    private function JsonToSQL($s)
    {
        $string = strtolower($this->Escape_win($s));

        //   [[["name","<","цук"],"or",["name","=",null]],"and",["url","=","цу"]]
        $patterns = array();

        $patterns[0] = '/\["(\w*)"/u'; //ПОЛЯ
        $patterns[1] = '/,"(and|or)",/u'; // ГРУППИРОВКА
        $patterns[2] = '/,"contains","(.*?)"/u'; // LIKE %%
        $patterns[3] = '/,"notcontains","(.*?)"/u'; // LIKE %%
        $patterns[4] = '/,"endswith","(.*?)"/u'; // LIKE  <%
        $patterns[5] = '/,"startswith","(.*?)"/u'; // LIKE  >%
        $patterns[6] = '/,"(>|<|=|<>|>=|<=)","(.*?)"/u';  // СИМВОЛЫ
        $patterns[7] = '/,"(>|<|=|<>|>=|<=)",(\d*)/u';  // СИМВОЛЫ
        $patterns[8] = '/,"(>|<|=|<>|>=|<=)",NULL/u'; // NULL
        $patterns[9] = '/\[/u';
        $patterns[10] = '/\]/u';

        $replacements = array();

        $replacements[0] = '($1';
        $replacements[1] = ' $1 ';
        $replacements[2] = ' like \'%$1%\'';
        $replacements[3] = ' not like \'%$1%\'';
        $replacements[4] = ' like \'%$1\'';
        $replacements[5] = ' like \'$1%\'';
        $replacements[6] = ' $1 \'$2\'';
        $replacements[7] = ' $1 $2';
        $replacements[8] = ' is null ';
        $replacements[9] = '(';
        $replacements[10] = ')';


        return preg_replace($patterns, $replacements, $string);
        // return preg_replace($patterns, $replacements, $string);
    }

    public function getApiResponse()
    {
   //     $model = Unit::class;
   //     $fields = ['id', 'code', 'name', 'slug', 'symbol_national', 'symbol_intern', 'code_national', 'code_intern', 'section', 'unit_group', 'descr'];

        $res = [];
        $skip = $this->request->skip;
        // по умолчанию лимит записей сделать 5
        if ($this->request->take == '') {
            $take = $this->take_default;
        } else {
            $take = $this->request->take;
        }


        $requireTotalCount = $this->request->requireTotalCount;
        $requireGroupCount = $this->request->requireGroupCount;
        $sort = json_decode($this->request->sort);
        $filters = json_decode($this->request->filter);
        $totalSummary = $this->request->totalSummary;
        $group = json_decode($this->request->group);
        $groupSummary = $this->request->groupSummary;
        $data = $this->model::take($take)->skip($skip);


//1) только при обычном отображении таблицы
        if (!$sort && !$group && !$filters) {
            //dd($fields);
            $res['data'] = $data->get($this->fields);
            $res['totalCount'] = $data->count();
        }

//2) только поиск
        if (!$sort && !$group && $filters) {
            $data = $data->whereRaw($this->JsonToSQL(json_encode($filters)));
            $res['data'] = $data->get($this->fields);
            $res['totalCount'] = $data->count();
        }

//3) если есть параметр групировки но нет сортировки и фильтра в запросе
        if (!$sort && $group && !$filters) {
            $data_group = [];
            $group_column = $group[0]->selector;
            if (array_key_exists('desc', (array)$group[0])) {
                $group_operator = ($group[0]->desc == true) ? 'asc' : 'desc';
            } else {
                $group_operator = 'asc';
            }
            $keys = $data->groupBy($group_column)->orderBy($group_column, $group_operator)->get($group_column)->toArray();
            foreach ($keys as $key) {
                $a = (array)$key;
                $items =$this->model::where($group_column, '=', $a[$group_column])->orderBy($group_column, $group_operator)->get();
                $data_group[] = ['key' => $a[$group_column], 'items' => $items, 'count' => count($items), 'summary' => [1, 3]];
            }
            $res['data'] = $data_group;
            $res['groupCount'] = $data->groupBy($group_column)->count();
            $res['totalCount'] = $data->count();
        }

//4) если есть параметр групировки и сортировки нет фильтрации в запросе
        if (!$sort && $group && $filters) {
            $data_group = [];
            $group_column = $group[0]->selector;
            if (array_key_exists('desc', (array)$group[0])) {
                $group_operator = ($group[0]->desc == true) ? 'asc' : 'desc';
            } else {
                $group_operator = 'asc';
            }
            $data = $data->whereRaw($this->JsonToSQL(json_encode($filters)));
            $keys = $data->groupBy($group_column)->orderBy($group_column, $group_operator)->get($group_column)->toArray();
            foreach ($keys as $key) {
                $a = (array)$key;
                $items = $this->model::where($group_column, '=', $a[$group_column])->whereRaw($this->JsonToSQL(json_encode($filters)))->get();
                $data_group[] = ['key' => $a[$group_column], 'items' => $items, 'count' => count($items), 'summary' => [1, 3]];
            }
            $res['data'] = $data_group;
            $res['groupCount'] = $data->groupBy($group_column)->count();
            $res['totalCount'] = $data->count();
        }

//5) если есть параметр сортировки и нет группировки и фильтра в запросе
        if ($sort && !$group && !$filters) {
            $sort_column = $sort[0]->selector;
            $sort_operator = ($sort[0]->desc == true) ? 'asc' : 'desc';
            $res['data'] = $data->orderBy($sort_column, $sort_operator)->get($this->fields);
            $res['totalCount'] = $data->count();
        }


//6) если есть параметр сортировки и фильтрации нет группировки в запросе
        if ($sort && !$group && $filters) {
            $sort_column = $sort[0]->selector;
            $sort_operator = ($sort[0]->desc == true) ? 'asc' : 'desc';
            $data = $data->whereRaw($this->JsonToSQL(json_encode($filters)));
            $res['data'] = $data->orderBy($sort_column, $sort_operator)->get($this->fields);
            $res['totalCount'] = $data->count();
        }


//7) если есть параметр групировки и сортировки в запросе
        if ($sort && $group && !$filters) {
            $data_group = [];
            $group_column = $group[0]->selector;
            if (array_key_exists('desc', (array)$group[0])) {
                $group_operator = ($group[0]->desc == true) ? 'asc' : 'desc';
            } else {
                $group_operator = 'asc';
            }
            $sort_column = $sort[0]->selector;
            $sort_operator = ($sort[0]->desc == true) ? 'asc' : 'desc';
            $keys = $data->groupBy($group_column)->orderBy($group_column, $group_operator)->get($group_column)->toArray();
            foreach ($keys as $key) {
                $a = (array)$key;
                $items = $this->model::where($group_column, '=', $a[$group_column])->orderBy($sort_column, $sort_operator)->get();
                $data_group[] = ['key' => $a[$group_column], 'items' => $items, 'count' => count($items), 'summary' => [1, 3]];
            }
            $res['data'] = $data_group;
            $res['groupCount'] = $data->groupBy($group_column)->count();
            $res['totalCount'] = $data->count();
        }


//8) если есть параметр групировки и сортировки и фильтрации в запросе
        if ($sort && $group && $filters) {
            $data_group = [];
            $group_column = $group[0]->selector;
            if (array_key_exists('desc', (array)$group[0])) {
                $group_operator = ($group[0]->desc == true) ? 'asc' : 'desc';
            } else {
                $group_operator = 'asc';
            }
            $sort_column = $sort[0]->selector;
            $sort_operator = ($sort[0]->desc == true) ? 'asc' : 'desc';
            $data = $data->whereRaw($this->JsonToSQL(json_encode($filters)));
            $keys = $data->groupBy($group_column)->orderBy($group_column, $group_operator)->get($group_column)->toArray();
            foreach ($keys as $key) {
                $a = (array)$key;
                $items = $this->model::where($group_column, '=', $a[$group_column])->whereRaw($this->JsonToSQL(json_encode($filters)))->orderBy($sort_column, $sort_operator)->get();
                $data_group[] = ['key' => $a[$group_column], 'items' => $items, 'count' => count($items), 'summary' => [1, 3]];
            }
            $res['data'] = $data_group;
            $res['groupCount'] = $data->groupBy($group_column)->count();
            $res['totalCount'] = $data->count();
        }
        return json_encode($res);

    }
}
