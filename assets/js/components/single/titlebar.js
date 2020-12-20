Vue.component('titlebar', {
    props: ['name', 'address', 'status', 'property_price', 'property_size', 'suburb', 'state', 'postcode', 'parent_property_id', 'from_price', 'property'],
    data:function(){
        return {
            formatPrice:paigAPIHelper.formatPropertyPrice,
            getFullAddress:paigAPIHelper.getFullAddress,
            getMapFullAddress:paigAPIHelper.getMapFullAddress,
            generateURL:paigAPIHelper.generateDetailPageUrl
        };
    },
    methods:{
        goBack(){       
            window.history.back();
        }
    }
});