Vue.component('property-sidebar', {
    props: ['display_id','prop_desc'],
    data: function () {
        return {
            savedItems: [],
            generateURL:paigAPIHelper.generateDetailPageUrl,
        };
    },
    mounted() {
        console.log(window.location);
    },
    created() {
        document.addEventListener("refreshPropertyListing", (res) => {
            this.savedItems = res.detail.items;
        });
        document.dispatchEvent(new CustomEvent("fetchPropertyListing"));
    },
    destroyed(){
        document.removeEventListener("refreshPropertyListing");
    },
    methods: {
        printPage: function () {
            window.print();
        },
        generateTemplate:function(){
            window.open('://www.hashtag-.eu5.org', '_blank');
        },
        getEmailLine: function () {
            console.log(window);
            return "subject=View property No:"+this.prop_desc.display_id+"&body=Please check this property"+this.prop_desc.title+" at"+window.location+".";
            // 'subject='+prop_desc+'body='+prop_desc.title+window.location
        },
        shareFacebook:function(){
            return 'http://www.facebook.com/share.php?u='+window.location;
        },
        shareTwitter:function(){
            return 'http://twitter.com/home?status='+window.location;
        },
        shareLinkedIn:function(){
            return 'https://www.linkedin.com/shareArticle?mini=true&url='+window.location;
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
        },
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
    }
});