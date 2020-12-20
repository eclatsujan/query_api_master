Vue.component('property-description', {
    props: ['prop_desc'],
    data: function () {
        return {
            getShortMetricText: paigAPIHelper.getShortMetricText,
            formatPropertyPrice: paigAPIHelper.formatPropertyPrice
        };

    },
    mounted: function () {

        let street_no = this.prop_desc.street_number != "" ? this.prop_desc.street_number : "";
        let street_address = this.prop_desc.street_address != "" ? this.prop_desc.street_address : "";
        let suburb = this.prop_desc.suburb != "" ? this.prop_desc.suburb : "";
        let state = this.prop_desc.state != "" ? this.prop_desc.state : "";
        let postcode = this.prop_desc.postcode != "" ? this.prop_desc.postcode : "";
        let country = this.prop_desc.country != "" ? this.prop_desc.country : "";
        let map_address = street_no + " " + street_address + " " + suburb + " " + state + " " + postcode + " " + country;

        let map_address1 = map_address.replace(/\s/g, '+');

    },
    methods: {
        extractFileName: function (param) {
            let file_name = param.substr(param.lastIndexOf('/') + 1)
            let str = file_name.replace(/-/g, ' ');
            let str1 = str.replace(/_/g, ' ');

            return str1;
        },
        renderIconClass: function (filepath) {
            let ext = filepath.split('.').pop();
            let iconClass = "fa-file-text";
            if (ext === 'pdf') {
                iconClass = "fa-file-pdf-o";
            } else if (ext === 'jpg' || ext === 'jpeg' || ext === 'png') {
                iconClass = "fa-file-image-o";
            }
            return iconClass;
        },
        getDatePattern: function (d, format = "en-AU") {
            let datePattern = new Date(d * 1000);
            return datePattern.toLocaleDateString(format).replace(/\//g, "-");;
        },
        displayFirstTwoWords(w) {
            return w.split(' ').slice(0, 2).join(' ');
        },
        renderMap: function (mapad) {
            axios.get("https://nominatim.openstreetmap.org/search?q=" + mapad + "format=geojson");

            let mymap = L.map('mapid').setView([-33.868540, 151.193830], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 19,
            }).addTo(mymap);

            mymap.dragging.disable();
            mymap.touchZoom.disable();
            mymap.doubleClickZoom.disable();
            mymap.scrollWheelZoom.disable();
        }


    }

});