Vue.component('properties-carousel', {
    props: ['default_property'],
    data: function () {
        return {
            properties: [],
            isLoading: true,
            formatPropertyPrice: paigAPIHelper.formatPropertyPrice,
            savedItems: [],
            generateURL: paigAPIHelper.generateDetailPageUrl
        };
    },
    mounted() {
        this.getDefaultListings();
    },
    created() {
        document.addEventListener("refreshPropertyListing", (res) => {
            this.savedItems = res.detail.items;
        });
        document.dispatchEvent(new CustomEvent("fetchPropertyListing"));
    },
    destroyed() {
        document.removeEventListener("refreshPropertyListing");
    },
    methods: {
        getDefaultListings: function () {
            let config = {};
            let defaultProperty = paigAPIHelper.defaultOptions.propertyType;
            let defaultStrategy = paigAPIHelper.defaultOptions.strategyType;


            if (defaultProperty !== "" && defaultProperty !== "All") {
                config["params"] = {
                    property_type: defaultProperty
                };
            }

            if (defaultProperty === "") {
                config["params"] = {
                    property_type: "Project"
                };
            }



            if (this.isSingle && (defaultStrategy !== "" && defaultStrategy !== "All")) {
                config["params"] = {
                    strategy_type: defaultStrategy
                };
            }

            axios.get(url + "api/list", config).then((response) => {
                this.properties = response.data.data;
                this.isLoading = false;
                Vue.nextTick(() => {
                    let event = new CustomEvent('render-carousel');
                    document.dispatchEvent(event);
                    document.dispatchEvent(new CustomEvent("isLoaded"));
                });
            }).catch(function (error) {
                console.log(error);
            });
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

    }
});