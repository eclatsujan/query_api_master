<pagination v-if="totalPages>1" v-bind:total_pages="totalPages" v-bind:total="total" v-bind:per_page="perPage"
            v-bind:current_page="currentPage" v-on:pagechanged="changePageNumber" inline-template>         
    <div class="text-center">
        <nav class="pagination">
            <ul class="pagination">
                <li>
                    <a @click="onClickFirstPage"
                       :disabled="isInFirstPage"
                       :class="getPointerEventsClassFirstPage"
                       aria-label="Go to first page">
                        <span>First</span>
                    </a>
                </li>
                <li class="pagination-item">
                    <a @click="onClickPreviousPage"
                       :disabled="isInFirstPage" aria-label="Go to first page"
                       :class="'pg-prev '+getPointerEventsClassFirstPage">
                        <span><i class="fas fa-angle-left" aria-hidden="true"></i>  </span>
                    </a>
                </li>

                <li v-for="page in pages" class="pagination-item">
                    <a @click="onClickPage(page.name)"
                       :class="{ current: isPageActive(page.name) }"
                       :disabled="page.isDisabled" aria-label="`Go to page number ${page.name}`">
                        <span>{{ page.name }}</span>
                    </a>
                </li>

                <li class="pagination-item">
                    <a @click="onClickNextPage"
                       :disabled="isInLastPage" aria-label="Go to next page"
                       :class="'pg-next '+getPointerEventsClassLastPage">
                        <span> <i class="fas fa-angle-right" aria-hidden="true"></i> </span>
                    </a>
                </li>

                <li class="pagination-item">
                    <a @click="onClickLastPage"
                       :disabled="isInLastPage" aria-label="Go to last page"
                       :class="getPointerEventsClassLastPage"
                    >
                        <span>Last</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</pagination>