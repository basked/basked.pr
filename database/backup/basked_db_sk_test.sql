INSERT INTO basked_db.sk_test (id, name, descr, created_at, updated_at, id_bas) VALUES (1, '<?php

use Illuminate\\Support\\Facades\\Schema;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Database\\Migrations\\Migration;

class CreateSkTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(''sk_test'', function (Blueprint $table) {
            $table->bigIncrements(''id'');
            $table->text(''name'');
            $table->string(''descr'');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(''sk_test'');
    }
}
', 'file1.php', null, null, 1);
INSERT INTO basked_db.sk_test (id, name, descr, created_at, updated_at, id_bas) VALUES (2, '/**
 * First we will load all of this project''s JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import ''bootstrap''


window.Vue = require(''vue'');

const axios = require(''axios'');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component(''skill-menu'', require(''../components/SkillMenu.vue'').default);
Vue.component(''skill-footer'', require(''../components/SkillFooter.vue'').default);
Vue.component(''dev-grid-technology'', require(''../components/DevGridTechnology.vue'').default);
Vue.component(''dev-grid-type'', require(''../components/DevGridType.vue'').default);
Vue.component(''dev-grid-developer'', require(''../components/DevGridDeveloper.vue'').default);
Vue.component(''dev-grid-roadmap'', require(''../components/DevGridRoadmap.vue'').default);
Vue.component(''dev-grid-topic'', require(''../components/DevGridTopic.vue'').default);
Vue.component(''dev-grid-topic-tabs'', require(''../components/DevGridTopicTabs.vue'').default);
Vue.component(''dev-grid-topic-examples'', require(''../components/DevGridTopicExamples.vue'').default);
Vue.component(''dev-grid-topic-links'', require(''../components/DevGridTopicLinks.vue'').default);
Vue.component(''dev-tree-technology'', require(''../components/DevTreeTechnology.vue'').default);
Vue.component(''block-code'', require(''../components/BlockCode.vue'').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: ''#app'',
});
', 'app.js', null, null, 2);