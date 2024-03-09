<template>
    <a ref="export_link" href="" class="hidden">download</a>
    <DataTable :value="src?.data ?? src" responsiveLayout="scroll"
               :paginator="src?.data?.length > 0"
               paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
               :globalFilterFields="['is_active' ]"
               :currentPageReportTemplate="`${$t('base.view')} {first} ${$t('base.to')} {last} ${$t('base.from')} {totalRecords}`"
               :lazy="true"
               @page="onPage($event)"
               @sort="onSort($event)"
               :loading="loading" removableSort
               :rows="src.per_page ?? src.meta?.per_page ?? src.length"
               :rowsPerPageOptions="[5,10,50,100,1000]"
               dataKey="id"
               :totalRecords="src.total ?? src.meta?.total ?? src.length"
               :autoLayout="true"
               ref="ref"
               scrollable showGridlines stripedRows resizableColumns columnResizeMode="expand"
               v-bind="$attrs">
        <slot/>
    </DataTable>
</template>

<script>
import DataTable from 'primevue/datatable';
import { router } from '@inertiajs/vue3'

export default {
    name: "ElDataTable",
    components: {
        DataTable
    },
    props: {
        src: Object,
        url: String,
        method: {
            type: String,
            default: 'get',
        }
    },
    data() {
        return {
            loading: false,
            filters: {Object},
        }
    },
    methods: {
        onPage(event) {
            this.filters = {
                'page': event.page + 1,
                'rows': event.rows,
                'sortField': event.sortField,
                'sortOrder': event.sortOrder,
            }
        },
        onSort(event) {
            this.filters = {
                'page': event.page ?? false ? envent.page + 1 : this.filters.page,
                'rows': event.rows ?? this.filters.rows,
                'sortField': event.sortField,
                'sortOrder': event.sortOrder,
            }
        },
        add_filter(filter) {
            this.filters.filter = filter;
        },
        exportCSV() {
            let current_url = (window.location.href).split("?")[1];
            this.$refs.export_link.href = this.url + '?' + (typeof current_url == 'undefined' ? 'export_excel=true' : current_url + '&export_excel=true');
            this.$refs.export_link.click();
        },
        exportRef() {
            this.$refs.ref.exportCSV({});
        }
    },

}
</script>

<style>
.p-datatable-table .p-frozen-column{
    right:0!important;
}
tr:nth-child(even) td.p-frozen-column {
    background: #F5F5F5!important;
}
.dark tr:nth-child(even) td.p-frozen-column {
    background: #1C2732!important;
}
</style>
