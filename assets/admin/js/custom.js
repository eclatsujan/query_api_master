WebFontConfig = {
    google: {
        families: ['Varela+Round']
    }
};

(function () {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
})();

(function ($) {
    $(document).ready(function () {
        $(".tabs").tabs();

        $("#email_address").on("input", function (e) {
            if (e.originalEvent.data === " ") {

            }
        });


        const url1 = csPaig.environment === "prod" ? "https://api.hashtagportal.com.au/" : "http://paigBackend.test/";

        const default_property = $("#property_type_select").data("property_type");

        axios.defaults.baseURL = url1;
        axios.interceptors.request.use(config => {
                if (csPaig.hasOwnProperty("accessToken")) {
                    config.headers['Authorization'] = 'Bearer ' + csPaig.accessToken;
                }
                // config.headers['Content-Type'] = 'application/json';
                return config;
            },
            error => {
                Promise.reject(error);
            });


        axios.get(url1 + "api/getInitialData", {
            // params: {
            //     //property_type: "Project",
            //     // status:"Available"
            // }
        }).then((response) => {
            var defaultPropertyType=$("#property_type_select").data("property_type");
            var defaultStrategyType=$("#strategy_type_select").data("strategy_type");

            let property_callback="";
            let strategy_callback="";

            if(defaultPropertyType!==""){
                property_callback=function(element){
                    return element===defaultPropertyType;
                };
            }

            if(defaultStrategyType!==""){
                strategy_callback=function(element){
                    return element===defaultStrategyType;
                };
            }

            renderSelectHtml("property_type_select", response.data["property_types"],property_callback);
            renderSelectHtml("strategy_type_select", response.data["strategy_types"],strategy_callback);


        }).catch(function (error) {
            console.log(error);
        });



        //api to get list of b2b partners
        axios.get(url1 + "api/getB2BPartners", {
            // params: {
            //     //property_type: "Project",
            //     // status:"Available"
            // }
        }).then((response) => {
            console.log(response);
            var b2b_partner=$("#b2b_partner_select").data("b2b_partner");
            let b2b_callback="";
            if(b2b_partner!==""){
                b2b_callback=function(element){
                    return element===b2b_partner;
                };
            }

            renderSelectHtml("b2b_partner_select", response.data["b2b_partners"],b2b_callback);


        }).catch(function (error) {
            console.log(error);
        });


    });

    function renderSelectHtml(target_id, data,$caller) {
        var html = '<option value="">All</option>';
        data.forEach(function(element){
            let checked="";
            if(typeof $caller==="function"){
                checked=$caller(element)===true?"selected":"";
            }

            html += "<option value='" + element + "'"+ checked+">" + element + "</option>";

        });
        $("#"+target_id).html(html);
    }


})(jQuery);