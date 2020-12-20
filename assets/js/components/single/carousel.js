Vue.component('carousel',{
    props:['single_images','title'],
    data:function(){
        return {
            dataChanged:false
        };
    },
    mounted:function(){
        this.dataChanged=true;
        Vue.nextTick(()=>{
           this.loadSlickCarousel();
        },1000);
    },
    methods:{
        loadSlickCarousel(){
            document.dispatchEvent(new CustomEvent("render-singleCarousel"));
        }
    }
});