<template>
    <div id="skill-menu">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Skill</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="http://basked.pr/skill/">Home <span class="sr-only">(current)</span></a>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle bg-dark" href="http://basked.pr/skill/technologies"
                           id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            Techology
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="http://basked.pr/skill/technologies">Techologies</a>
                            <a class="dropdown-item" href="http://basked.pr/skill/types">Types</a>
                            <a class="dropdown-item" href="http://basked.pr/skill/technologies/print-tree">Print
                                tree</a>
                            <a class="dropdown-item" href="http://basked.pr/skill/technologies/print-tree-template">Print tree in template</a>
                            <a class="dropdown-item" href="http://basked.pr/skill/technologies/print-tree-data">Tree DATA</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="http://basked.pr/skill/technologies/test-technologies">Test</a>
                        </div>
                    </li>
                    <a class="nav-item nav-link" href="http://basked.pr/skill/developers">Developers</a>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        name: "SkillMenu"
    }
</script>

<style scoped>

</style>
