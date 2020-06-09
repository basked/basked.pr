INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (1, 1, 'Изменяемые и неизменяемые переенные', 'var i; val k;', 'izmenyaemye-i-neizmenyaemye-pereennye', null, null, '2020-06-08 07:07:36');
INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (2, 1, 'Константы', 'const URL', 'konstanty', null, null, '2020-03-03 20:55:38');
INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (3, 6, 'Оператор IF', 'val i=null
if (i=null){print("Var is null")} 
else println("i=$i")', 'operator-if', null, '2020-03-09 13:31:17', '2020-03-09 13:31:17');
INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (4, 6, 'Оператор When', 'k=null
when(k){
 null->println("null")
4->prontln("4")
}', 'operator-when', null, '2020-03-09 13:32:41', '2020-03-09 13:32:41');
INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (5, 7, 'Параметры функций', 'fun foo(name: String, number: Int=42, toUpperCase: Boolean=false) =
        (if (toUpperCase) name.toUpperCase() else name) + number

fun useFoo() = listOf(
        foo("a"),
        foo("b", number = 1),
        foo("c", toUpperCase = true),
        foo(name = "d", number = 2, toUpperCase = true)
)', 'parametry-funktsiy', null, '2020-03-10 10:17:52', '2020-03-10 10:17:52');
INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (6, 1, 'Неизменяемая константа (ни в коем случае)', '// Не измениться ни при каких условиях
const val  MAX_EXPERIENCE=500', 'neizmenyaemaya-konstanta-ni-v-koem-sluchae', null, '2020-03-12 12:41:09', '2020-03-12 12:41:09');
INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (7, 7, 'Условное выражение', '/*Условное выражение — это почти условный оператор, с той лишь разницей, 
что результат оператора if/else присваивается переменной, которая будет 
использоваться в дальнейшем. Обновите вывод о состоянии здоровья, чтобы 
увидеть, как это работает.
*/

 val healthStatus = if (healthPoints == 100)', 'uslovnoe-vyrazhenie', null, '2020-03-13 05:12:03', '2020-03-13 05:12:03');
INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (9, 8, 'Как убрать  Header в приложении', null, 'kak-ubrat-header-v-prilozhenii', null, '2020-06-03 07:34:07', '2020-06-03 07:34:07');
INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (10, 9, 'Вывод данных по компоненту в консоль', 'При создании компонента в mounted можно вызвать console.log(this) , тем самым вывести в консоль все свойства, методы обработчики событий', 'vyvod-dannykh-po-komponentu-v-konsol', null, '2020-06-09 05:52:06', '2020-06-09 05:52:06');