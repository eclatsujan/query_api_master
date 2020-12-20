Vue.component('listing-table', {
    props: ['all_lists','strategy_type'],
    data: function () {
        return {
            isBathroomHeader:false,
            displayFirstTwoWords: paigAPIHelper.displayFirstTwoWords,
            getShortMetricText:paigAPIHelper.getShortMetricText,
            formatPrice:paigAPIHelper.formatPropertyPrice,
            headers:[],
            values:[],
            generateURL:paigAPIHelper.generateDetailPageUrl,
        };
    },
    created:function(){
        // let headers=[
        //     {
        //         key:"Property Type",
        //         value:"property_type",

        //     },
        //     {
        //         key:""
        //     }
        //     "Lot No",
        //     "Bath Room",
        //     "Bed Room",
        //     "Car",
        //     "
        //
        //     Land Area",
        //     "Int Area","Ext Area","Total Floor Area","Land Price","Build Price","Total Price","Status"
        //         ];
        // if(this.strategy_type==="New Land Estates"){
        //     headers[5]="Length Land";
        //     headers[6]="Width Land";
        // }
        // this.all_lists.forEach((list)=>{
            
        // });
    },
    mounted: function () {
       this.$nextTick(()=>{
            document.dispatchEvent(new CustomEvent("render-table"));
       });
    },
    methods: {
        getStatusClassName(status) {
            return status === 'Available' ? "c-green" : "c-red";
        },
        
    }
});