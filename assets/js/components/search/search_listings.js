Vue.component('searchlistings',{
    props:['msg'],
    data:function(){
        return {
            properties:[],
            list_class:"grid-layout",
            totalPages:0,
            total:0,
            perPage:0,
            currentPage:0,
            isLoading:true,
            sortOn:"from_price|asc",
            orderBy:"from_price",
            orderType:"asc",
            // displayDeveloperFilter:helper.defaultOptions.display_developer_filter,
            // selectedDeveloper:"",
            // buildContractDevelopers:[],
            formatPrice:paigAPIHelper.formatPropertyPrice,
            getFullAddress:paigAPIHelper.getFullAddress,
            getMapFullAddress:paigAPIHelper.getMapFullAddress,
            getShortMetricText:paigAPIHelper.getShortMetricText,
            savePropertyItem: paigAPIHelper.savePropertyItem,
            savedItems: [],
            resetSavedPropeties: paigAPIHelper.resetSavedPropeties,
            generateURL:paigAPIHelper.generateDetailPageUrl,
            defaultOptions:helper.defaultOptions
        };
    },
    mounted(){
        this.searchListingData(this.getURLStructure());
        // if(this.displayDeveloperFilter == '1'){
        //     this.getBuildContractDevelopers();
        // }

    },
    methods:{
        convertURL(str){
            str = str.replace(/&/g, "amp;");
            str = str.replace(/>/g, "gt;");
            str = str.replace(/</g, "lt;");
            str = str.replace(/"/g, "quot;");
            str = str.replace(/'/g, "#039;");
            return str;
        },
        changePageNumber(page){
            this.searchListingData(this.getURLStructure(page));
        },
        getURLStructure(page){
            let params = new URLSearchParams(window.location.search);

            //if search keyword is integer search property without any other condition
            if(Number.isNaN(parseInt(params.get("keyword")))){
                if(!params.has("strategy_type")){
                    params.set("strategy_type",this.defaultOptions.strategyType);
                }

                if(!params.has("property_type")&&this.defaultOptions.propertyType===""){
                    params.set("property_type","Project");
                }
                else if(!params.has("property_type")){
                    params.set("property_type",this.defaultOptions.propertyType);
                }
            }

            let url="?"+params.toString();
            if(typeof page!=="undefined"){
                url+="&page="+page;
            }
            return url;
        },
        sortListing(orderBy,orderType){
            let params = new URLSearchParams(window.location.search);
            if(orderBy!==""&&orderType!==""){
                !params.has("orderBy")?params.append("orderBy",orderBy):params.set("orderBy",orderBy);
                !params.has("orderType")?params.append("orderType",orderType):params.set("orderType",orderType);
            }
            else{
                params.delete("orderBy");
                params.delete("orderType");
            }

            this.searchListingData("?"+params.toString(),false);
        },
        // filterByDeveloper(developer){
        //     console.log("Ye yes"+developer);
        //     let params = new URLSearchParams(window.location.search);
        //
        //     !params.has("business_name")?params.append("business_name",developer):params.set("business_name",developer);
        //
        //     this.searchListingData("?"+params.toString(),false);
        // },
        searchListingData(uri,isJump=true){
            this.isLoading=true;
            if(isJump){
                this.jumpToTop();
            }

            axios.get("api/list"+uri).then((response)=>{
                this.totalPages=response.data.last_page;
                this.total=response.data.total;
                this.perPage=response.data.per_page;
                this.currentPage=response.data.current_page;
                this.properties= response.data.data;

                setTimeout(()=>{
                    this.isLoading=false;
                    this.renderCarousel();
                    document.dispatchEvent(new CustomEvent("isLoaded"));
                },1000);

            }).catch((err)=>{

            });
        },
        // getBuildContractDevelopers(){
        //     axios.get("api/getBuildContractDevelopers").then((response)=>{
        //         this.buildContractDevelopers = response.data.build_contract_developers;
        //             setTimeout(()=>{
        //             this.isLoading=false;
        //         },1000);
        //
        //     }).catch((err)=>{
        //
        //     });
        // },
        renderCarousel(){
            Vue.nextTick(()=>{
                let event=new CustomEvent('render-carousel');
                let vuedata_event=new CustomEvent("vue-data-load");
                document.dispatchEvent(event);
                document.dispatchEvent(vuedata_event);
            });
        },
        jumpToTop(){
            console.log(jQuery("#paigApp").height());
            // console.log( jQuery("#paigApp").offset().top);
            jQuery("html,body").animate({ scrollTop: jQuery("#paigApp").offset().top-300});
        },
        changeListClass(layout){

            this.list_class=layout;
            let cs_event=new CustomEvent('refresh-carousel');
            document.dispatchEvent(cs_event);
        },

        saveProperty: function (property) {
            document.dispatchEvent(new CustomEvent("addPaigFavouriteItems", {
                detail: {
                    item: {
                        display_id: property.display_id,
                        title: property.title,
                        images: property.attachments.photo,
                        from_price: property.from_price,
                        status: property.status
                    }
                }
            }));
        },
        isSaved: function (display_id) {
            let result = this.savedItems.find((item) => {
                return item.display_id === display_id;
            });

            if (typeof result === "undefined") {
                return "unsaved";
            } else {
                return "saved";
            }
        }
    },
    watch:{
        sortOn: function(val){
            let sort = val.split("|");
            if(sort.length===2){
                this.sortListing(sort[0],sort[1]);
            }
            else{
                this.sortListing("","");
            }
        },
        // selectedDeveloper:function (val){
        //     if(val !== '') {
        //         this.filterByDeveloper(val);
        //     }
        // }
    },
    created() {
        document.addEventListener("refreshPropertyListing", (res) => {
            this.savedItems = res.detail.items;
        });
        document.dispatchEvent(new CustomEvent("fetchPropertyListing"));
    },
    destroyed(){
        document.removeEventListener("refreshPropertyListing");
    }
});