Vue.component('searchbar', {
    props: ['search_url'],
    data: function () {
        return {
            property_type: [],
            strategy_type: [],
            property_types: [],
            strategy_types: [],
            defaultPrices: [],
            areaOptions:[],
            suggestedList: [],
            suburb: "",
            state: "",
            postcode: "",
            status: "sale",
            keyword: "",
            min_price: "",
            max_price: "",
            orderBy: "from_price",
            orderType: "asc",
            buildContractDevelopers:[],
            displayDeveloperFilter:helper.defaultOptions.display_developer_filter,
            selectedDeveloper:"",
            business_name:[],
            displayAreaFilter:helper.defaultOptions.display_area_filter,
            min_floor_area:"",
            max_floor_area:"",
            displaySuggestionBox: false,
            showRefine: false
        };
    },
    mounted: function () {
        // var $this=this;
        window.addEventListener("click", (event) => {
            // this.$refs.strategy_select.closeSearchOptions();
            // this.$refs.property_select.closeSearchOptions();
            // this.$refs.min_price_select.closeSearchOptions();
            // this.$refs.max_price_select.closeSearchOptions();
        });


        let prices = [];
        for (let i = 50000; i <= 4000000;) {
            prices.push(i);
            i = i <= 950000 ? i + 50000 : i + 500000;
        }
        this.defaultPrices = prices;

        //filter for search by floor area
        if(this.displayAreaFilter == "1"){
            optionsArr = [];
            for (let i = 25; i <= 300;i=i+25) {
                optionsArr.push(i);
            }
            this.areaOptions=optionsArr;
        }

        if(this.displayDeveloperFilter == '1'){
            this.getBuildContractDevelopers();
        }

        axios.get("api/getInitialData")
            .then((response) => {

                let defaultProperty = paigAPIHelper.defaultOptions.propertyType;
                let defaultStrategy = paigAPIHelper.defaultOptions.strategyType;
                let isSingleProperty = paigAPIHelper.defaultOptions.isSingleProperty;
                let isSingleStrategy = paigAPIHelper.defaultOptions.isSingleStrategy;

                if (isSingleProperty && (defaultProperty !== "" && defaultProperty !== "All")) {
                    this.property_types.push(defaultProperty);
                } else {
                    let property_types = response.data["property_types"];
                    property_types.push("");
                    this.property_types = property_types;
                }

                if (isSingleStrategy && (defaultStrategy !== "" && defaultStrategy !== "All")) {
                    this.strategy_types.push(defaultStrategy);
                } else {
                    let strategy_types = response.data["strategy_types"];
                    strategy_types.push("");
                    this.strategy_types = strategy_types;
                }

                this.setCurrentState();

                Vue.nextTick(function () {
                    document.dispatchEvent(new CustomEvent("isLoaded"));
                });
            })
            .catch((error) => {
                console.log(error);
            });

        window.addEventListener("click", () => {
            this.displaySuggestionBox = false;
        });
    },
    watch: {
        suggestedList: function (value) {
            console.log(value);
        }
    },
    methods: {
        formatPrice(price) {
            return "$ " + price.toLocaleString();
        },
        convertURL(url) {
            console.log('hello boy hello boy');
            if (typeof url === "string") {
                if (url !== '') {
                    url = url.replace(/&/g, "amp;");
                    url = url.replace(/\+/g, "plus;");
                }
                return url;
            } else if (Number.isInteger(url)) {
                return url;
            } else {

                return url.map(function (single_url) {
                    single_url = single_url.replace(/&/g, "amp;");
                    single_url = single_url.replace(/\+/g, "plus;");
                    return single_url;
                }).join();
            }
        },
        reverseConvertURL(str) {
            if (str !== '' && !Number.isInteger(str)) {
                str = str.replace("amp;", "&");
                str = str.replace("plus;", "+");
            }
            return str;
        },
        search(event) {
            event.preventDefault();
            // console.log(this.generateURL());
            window.location.href = this.generateURL();
        },
        setCurrentState() {
            let defaultProperty = paigAPIHelper.defaultOptions.propertyType;
            let defaultStrategy = paigAPIHelper.defaultOptions.strategyType;
            let isSingleProperty = paigAPIHelper.defaultOptions.isSingleProperty;
            let isSingleStrategy = paigAPIHelper.defaultOptions.isSingleStrategy;

            let params = new URLSearchParams(window.location.search);
            if (params.has("state")) {
                this.state = params.get("state");
            }
            if (params.has("status")) {
                this.status = params.get("status");
            }
            if (params.has("keyword")) {
                this.keyword = params.get("keyword");
            }

            if (params.has("strategy_type")) {
                let strategy_type = [];
                if (params.get("strategy_type") !== "") {
                    let url_properties = this.reverseConvertURL(params.get("strategy_type")).split(",");
                    strategy_type = this.strategy_types.filter((type) => {
                        return url_properties.indexOf(type) !== -1;
                    });
                }
                if (strategy_type) {
                    this.strategy_type = strategy_type;
                }
            } else if (defaultStrategy !== "" && defaultStrategy !== "All") {
                this.strategy_type = defaultStrategy;
            }

            if (params.has("property_type")) {
                let property_type = [];
                if (params.get("property_type") !== "") {
                    let url_properties = this.reverseConvertURL(params.get("property_type")).split(",");
                    property_type = this.property_types.filter((type) => {
                        return url_properties.indexOf(type) !== -1;
                    });
                } else {
                    this.property_type = params.get("property_type");
                }
                if (property_type) {
                    this.property_type = property_type;
                }
            } else if (defaultProperty !== "" && defaultProperty !== "All") {
                this.property_type = defaultProperty;
            }

            if (params.has("business_name")) {
                let business_name = [];
                if (params.get("business_name") !== "") {
                    let url_properties = this.reverseConvertURL(params.get("business_name")).split(",");

                    business_name = this.buildContractDevelopers.filter((type) => {
                        return url_properties.indexOf(type) !== -1;
                    });
                } else {
                    this.business_name = params.get("business_name");
                }
                if (business_name) {
                    this.business_name = business_name;
                }
            }

            if (params.has("min_price")&& params.get("min_price") ) {
                this.min_price = params.get("min_price");
            }
            if (params.has("max_price") && params.get("max_price")) {
                this.max_price = params.get("max_price");
            }


            if (params.has("min_floor_area")) {
                this.min_floor_area = params.get("min_floor_area");
            }
            if (params.has("max_floor_area")) {
                this.max_floor_area = params.get("max_floor_area");
            }


        },
        generateURL() {
            let url = this.search_url + "?";
            let excludedKeys = ["property_types",
                "strategy_types",
                "suggestedList",
                "displaySuggestionBox",
                "defaultPrices",
                "showRefine",
                "buildContractDevelopers",
                "displayDeveloperFilter",
                "displayAreaFilter",
                "areaOptions"
            ];

            //if search keyword is integer search property without any other condition
            if (!Number.isNaN(parseInt(this.keyword))) {
                excludedKeys.push("property_type");
                excludedKeys.push("strategy_type");
            }

            console.log(this.$data);

            Object.keys(this.$data).forEach((key) => {
                if (!excludedKeys.includes(key)) {
                    console.log(key);
                    if(this.$data[key] !== null){
                        url += key + "=" + this.convertURL(this.$data[key]) + "&";
                    }

                }
            });

            // !params.has("business_name")?params.append("business_name",developer):params.set("business_name",developer);

            return url;
        },
        suggestKeyword() {
            var state = paigAPIHelper.defaultOptions.state;
            if (this.keyword.length > 2) {

                let config_params = {
                    params:{
                        search_term:this.keyword,
                        state:state
                    }
                }
                this.suggestedList = [];
                // axios.get("api/suggestedKeyword?search_term=" + this.keyword)
                 axios.get("api/suggestedKeyword",config_params)
                    .then((response) => {

                        Object.keys(response.data).forEach((key) => {
                            console.log(key);
                            let address = response.data[key].suburb + ", " + response.data[key].state + ", " + response.data[key].postcode;
                            this.$set(this.suggestedList, key, address);
                        });
                        if (this.suggestedList.length > 0) {
                            this.displaySuggestionBox = true;
                        }

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }

        },

        changeKeywordState(search_keyword) {
            this.keyword = search_keyword;
            this.displaySuggestionBox = false;
            document.getElementsByClassName('suggestion-block')[0].style.visibility = 'hidden';
        },
        toggleRefine() {
            this.showRefine = !this.showRefine;
        },
        getRefineClass() {
            return !this.showRefine ? "fa-plus-circle" : "fa-minus-circle";
        },
        onPropertySelect(property) {

        },
        getBuildContractDevelopers(){
            axios.get("api/getBuildContractDevelopers").then((response)=>{
                this.buildContractDevelopers = response.data.build_contract_developers;
                setTimeout(()=>{
                    this.isLoading=false;
                },1000);

            }).catch((err)=>{

            });
        }
    }
});