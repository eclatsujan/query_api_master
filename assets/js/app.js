(function(){
    Vue.component('v-select', VueSelect.VueSelect);
    if (document.querySelector("#paigSearch") !== null) {
        new Vue({
            el: "#paigSearch",
            data: function () {
                return {
                    text: "Hello",
                    properties: []
                };
            },
            methods: {
                
            }
        });
    }


    if (document.querySelector("#compareProperties") !== null) {
        new Vue({
            el: "#compareProperties",
            data: function () {
                return {
                    text: "Hello",
                    properties: []
                };
            },
            methods: {
                
            }
        });
    }

    if(document.querySelector("#paigApp")!==null){
         new Vue({
            el: "#paigApp",
            data: function () {
                return {
                    properties: []
                };
            }
        });
    }

    
})();
