Vue.component('single-detail',{
    props:['display_id'],
    data:function(){
        return {
            singleProperty:{},
            singleImages:[],
            isLoading:true,
            generateURL:paigAPIHelper.generateDetailPageUrl,
        };
    },
    mounted:function(){
        axios.get("api/list/detail/"+this.display_id)
        .then((response)=>{
            let house_land_doc=[];
            let documents=[];
            
            if(response.data.attachments.hasOwnProperty("documents")){
                if(response.data.attachments.documents.length>0){
                    response.data.attachments.documents.forEach((document)=>{
                        if(document.includes("House_Brochure")){
                            house_land_doc.push(document);
                        }
                        else{
                            documents.push(document);
                        }
                    });
                }
            }
            
            response.data.attachments.documents=documents;
            response.data.attachments["house_land_documents"]=house_land_doc;

            this.singleProperty=response.data;
            this.singleImages=response.data.attachments.photo;
            Vue.nextTick(()=>{
                document.dispatchEvent(new CustomEvent("isSingleLoaded"));
                // this.isLoading=false;
            });
        })
        .catch(function (error) {
            Vue.nextTick(()=>{
                document.dispatchEvent(new CustomEvent("isSingleLoaded"));
                // this.isLoading=false;
            });
        });
    },
    methods:{
        setStatus(value){
        },
        printPage(){
            window.print();
        },
        savePropertyData(property_id){
           // window.paigAPIHelper.savedItems(property_id);
        },
        debug(){
            debugger;
        }
    }
});