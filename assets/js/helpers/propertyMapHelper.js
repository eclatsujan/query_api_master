//setup axios
const url = csPaig.environment === "prod" ? "https://api.hashtagportal.com.au/" : "http://paigbackend.test/";

axios.defaults.baseURL = url;
axios.interceptors.request.use(function (config) {
    if (csPaig.hasOwnProperty("accessToken")) {
        config.headers['Authorization'] = 'Bearer ' + csPaig.accessToken;
    }
    if(!config.hasOwnProperty("params")){
        config["params"]={};
    }
    if(Boolean(csPaig.isSinglePropertyType)&&(csPaig.default_property_type!==""&&csPaig.default_property_type!=="All")){
        config["params"]["property_type"]=csPaig.default_property_type;
    }
    if(Boolean(csPaig.isSingleStrategyType)&&(csPaig.default_strategy_type!==""&&csPaig.default_strategy_type!=="All")){
        config["params"]["strategy_type"]=csPaig.default_strategy_type;
    }

    if(csPaig.b2b_partner !== ''){
        config["params"]["b2b_partner"] = csPaig.b2b_partner;
    }

    if(csPaig.selected_state !== ''){
        config["params"]["state"] = csPaig.selected_state;
    }
    return config;
}, function (error) {
    Promise.reject(error);
});

let helper = {};

helper.defaultOptions = Object.freeze({
    "propertyType":csPaig.default_property_type,
    "strategyType":csPaig.default_strategy_type,
    "isSingleProperty":Boolean(csPaig.isSinglePropertyType),
    "isSingleStrategy":Boolean(csPaig.isSingleStrategyType),
    "b2b_partner":csPaig.b2b_partner,
    "state":csPaig.selected_state,
    "display_developer_filter":csPaig.display_developer_filter,
    "display_area_filter":csPaig.display_area_filter
});

let validator = {};

const errorMessages = {
    "empty": "The Field is empty",
    "email": "Please enter valid email address",
    "min": "Please enter words with minimum length of {key}",
    "max": "Please enter words with maximum length of {key}",
};

validator.empty = function (val) {
    return val !== "";
};


validator.email = function (val) {
    const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    return val.match(mailformat);
};

validator.min = function (val, length) {
    return val.length >= length;
};

validator.max = function (val, length) {
    return val.length >= length;
};

helper.getErrorMessage = function (rule,) {
    let errorMsg = null;
    let rules = rule.split("|");
    if (errorMessages.hasOwnProperty(rules[0])) {
        errorMsg = errorMessages[rules[0]];
        if (rules.length > 1) {
            errorMsg = errorMsg.replace("{key}", rules[1]);
        }
    }
    return errorMsg;
};

validator.validate = function (rule_name, key, value) {
    let rules = rule_name.split("|");
    if (validator.hasOwnProperty(rules[0])) {
        return rules.length > 1 ? validator[rules[0]](value, rules[1]) : validator[rules[0]](value);
    }
};


helper.getFullAddress = function (property) {

    let address = "";
    if (property.hasOwnProperty("address") && property.hasOwnProperty("location")) {
        if (property.address != '') {
            address = property.address + ", " + property.location;
        } else {
            address = property.location;
        }

    }

    return address;
};

helper.getMapFullAddress = function (property) {
    let address = "";
    if (property.hasOwnProperty("address") && property.hasOwnProperty("location")) {
        address = property.address + ", " + property.location;
    }
    return "https://maps.google.com/maps?q=" + address
};

helper.formatPropertyPrice = function (price) {

    if(isNaN(price)){
        return price;
    }else{
        return "$" + parseInt(price).toLocaleString();
    }

};


helper.displayFirstTwoWords = function (w) {
    return w.split(' ').slice(0, 2).join(' ');
};

helper.generateDetailPageUrl = function(url){
    return csPaig.site_url+url;
};

helper.getShortMetricText = function (metric) {

    let metrics = {
        "Metres": {
            "shortText": "m"
        },
        "Square Metres": {
            "shortText": "m<sup>2</sup>"
        }
    };

    return Object.keys(metrics).includes(metric) ? metrics[metric]["shortText"] : "";
};

const savePropertyItem = function (favProperty) {
    let savedItems = getPropertyItems();
    let result = savedItems.find((item) => {
        return item.display_id === favProperty.display_id;
    });

    if (typeof result === "undefined") {
        savedItems.push(favProperty);
        localStorage.setItem("paig_saved_property", JSON.stringify(savedItems));
    } else {
        removeSavedItem(favProperty.display_id);
    }
};


const resetSavedPropeties = function () {
    localStorage.setItem("paig_saved_property", JSON.stringify([]));
};


const removeSavedItem = function (display_id) {
    let savedItems = getPropertyItems();
    let newItems = savedItems.filter((item) => {
        return item.display_id !== display_id;
    });

    localStorage.setItem("paig_saved_property", JSON.stringify(newItems));
};

const getPropertyItems = function () {
    return localStorage.getItem("paig_saved_property") ? JSON.parse(localStorage.getItem("paig_saved_property")) : [];
};

const sendEventResponse = function () {
    document.dispatchEvent(new CustomEvent('refreshPropertyListing', {
        detail: {
            items: getPropertyItems()
        }
    }));
};

document.addEventListener("addPaigFavouriteItems", function (event) {
    // helper.getPropertyItems();
    savePropertyItem(event.detail.item);
    sendEventResponse();
});

document.addEventListener("removePaigFavouriteItems", function (event) {
    removeSavedItem(event.detail.display_id);
    sendEventResponse();
});

document.addEventListener("resetFavouriteItems", function (event) {
    resetSavedPropeties();
    sendEventResponse();
});

document.addEventListener("fetchPropertyListing", function (event) {
    sendEventResponse();
});

// helper.loadItems();

helper.validator = validator;

window.paigAPIHelper = helper;
