Vue.component('property-details',{
    props:['property'],
    mounted:function(){
        
        console.log(this.property.title);
    }
});