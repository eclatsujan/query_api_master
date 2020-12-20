Vue.component('compare-properties', {
    props: [],
    data: function () {
        return {
            favProperties: [],
            formatPropertyPrice: paigAPIHelper.formatPropertyPrice,
            savedItems: [],
            isActive:false
        }
    },
    mounted:function() {
        document.dispatchEvent(new CustomEvent("isLoaded"));
    },
    created:function(){
        document.addEventListener("refreshPropertyListing",(res)=>{
            this.savedItems=res.detail.items;
        });
        document.dispatchEvent(new CustomEvent("fetchPropertyListing"));
    },
    methods: {
        getFavouriteListings: function () {
            return this.savedItems;
        },
       
        removeProperty:function(property){
            document.dispatchEvent(new CustomEvent("removePaigFavouriteItems",{
                detail:{
                    display_id:property.display_id,
                }
            }));
        },

        resetFavouriteListings: function () {
            document.dispatchEvent(new CustomEvent("resetFavouriteItems"));
        },
        toggleActive(){
            this.isActive=!this.isActive;
        },
        getActiveClass(){
            return this.isActive?"active":"";
        }
    }
});