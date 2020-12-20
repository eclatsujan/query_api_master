const Pagination = {
    name: "pagination",
    // template: "#pagination",
    props: {
        max_visible_buttons: {
            type: Number,
            required: false,
            default: 5
        },

        total_pages: {
            type: Number,
            required: true
        },

        total: {
            type: Number,
            required: true
        },

        per_page: {
            type: Number,
            required: true
        },

        current_page: {
            type: Number,
            required: true
        }
    },


    computed: {
        startPage() {
            if (this.current_page === 1) {
                return 1;
            }

            if (this.current_page === this.total_pages) {
                return this.total_pages - this.max_visible_buttons + 1;
            }

            return this.current_page;
        },
        endPage() {
            return Math.min(this.startPage + this.max_visible_buttons - 1,
                this.total_pages);

        },
        pages() {
            const range = [];

            console.log("Total Pages ="+this.total_pages);

                for (let i = this.startPage; i <= this.endPage; i += 1) {
                    if(i>0) {
                        range.push({
                            name: i,
                            isDisabled: i === this.current_page
                        });
                    }

                }
            console.log(range);
                return range;


        },
        isInFirstPage() {
            return this.current_page === 1;
        },
        isInLastPage() {
            return this.current_page === this.total_pages;
        },
        getPointerEventsClassLastPage(){
           return  this.current_page === this.total_pages?"pointer-events-none":"pointer-events-auto";
        },
        getPointerEventsClassFirstPage(){
           return  this.current_page === 1?"pointer-events-none":"pointer-events-auto";
        }

    },

    methods: {

        onClickFirstPage() {
            this.$emit("pagechanged", 1);
        },
        onClickPreviousPage() {
            this.$emit("pagechanged", this.current_page - 1);
        },
        onClickPage(page) {
            this.$emit("pagechanged", page);
        },
        onClickNextPage() {
            this.$emit("pagechanged", this.current_page + 1);
        },
        onClickLastPage() {
            this.$emit("pagechanged", this.total_pages);
        },
        isPageActive(page) {
            return this.current_page === page;
        }
    }
};

Vue.component('pagination', Pagination);
