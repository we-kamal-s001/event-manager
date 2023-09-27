<script setup>
import {vaah} from '../../../vaahvue/pinia/vaah'
import {useEventsStore} from '../../../stores/store-events'
import {onMounted} from "vue";
import {useRoute} from "vue-router";

const store = useEventsStore();
const useVaah = vaah();
const route = useRoute();

onMounted(async () => {
    if (route.params && route.query.manager_slug) {
        await store.managerFilter(route.query.manager_slug);
    }
    await store.getFormMenu();
});
</script>

<template>

    <div v-if="store.list">
        <!--table-->
        <DataTable :value="store.list.data"
                   dataKey="id"
                   class="p-datatable-sm p-datatable-hoverable-rows"
                   v-model:selection="store.action.items"
                   stripedRows
                   responsiveLayout="scroll">

            <Column selectionMode="multiple"
                    v-if="store.isViewLarge()"
                    headerStyle="width: 3em">
            </Column>

            <Column field="id" header="ID" :style="{width: store.getIdWidth()}" :sortable="true">
            </Column>

            <Column field="name" header="Name"
                    :sortable="true">

                <template #body="prop">
                    <Badge v-if="prop.data.deleted_at"
                           value="Trashed"
                           severity="danger"></Badge>
                    {{prop.data.name}}
                </template>

            </Column>


            <Column field="type" header="Event Category"
            >

                <template #body="prop">
                        <li v-for="category in prop.data.category" :key="category.id" style="list-style: none;">
                            {{ category.get_taxonomy.name }}
                        </li>
                </template>

            </Column>


            <Column field="manager" header="Manager Name"
            >

                <template #body="prop">
                    <Badge v-if="prop.data.deleted_at && prop.data.manager"
                           value="Trashed"
                           severity="danger"></Badge>
                    {{prop.data.manager.name}}
                </template>

            </Column>


            <Column field="updated_at" header="Updated"
                    v-if="store.isViewLarge()"
                    style="width:150px;"
                    :sortable="true">

                <template #body="prop">
                    {{useVaah.toLocalTimeShortFormat(prop.data.updated_at)}}
                </template>

            </Column>

            <Column field="is_active" v-if="store.isViewLarge()"
                    :sortable="true"
                    style="width:100px;"
                    header="Is Active">

                <template #body="prop">
                    <InputSwitch v-model.bool="prop.data.is_active"
                                 data-testid="events-table-is-active"
                                 v-bind:false-value="0" v-bind:true-value="1"
                                 class="p-inputswitch-sm"
                                 @input="store.toggleIsActive(prop.data)">
                    </InputSwitch>
                </template>

            </Column>

            <Column field="actions" style="width:150px;"
                    :style="{width: store.getActionWidth() }"
                    :header="store.getActionLabel()">

                <template #body="prop">
                    <div class="p-inputgroup ">
                        <Button class="p-button-tiny p-button-text"
                                data-testid="events-table-to-view"
                                v-tooltip.top="'View'"
                                v-if="store.hasPermission(store.assets.permission,'events-can-manage-events')
                                   ||store.hasPermission(store.assets.permission,'events-can-view-events')"
                                @click="store.toView(prop.data)"
                                icon="pi pi-eye"/>
                        <div v-if="prop.data.id!==store.item.id || store.isViewLarge() && prop.data.deleted_at">
                            <Button class="p-button-tiny p-button-text"
                                    data-testid="events-table-to-edit"
                                    v-tooltip.top="'Update'"
                                    v-if="store.hasPermission(store.assets.permission,'events-can-manage-events')
                                   ||store.hasPermission(store.assets.permission,'events-can-update-events')"
                                    @click="store.toEdit(prop.data)"
                                    icon="pi pi-pencil"/>
                        </div>
                        <div v-else>
                            <Button class="p-button-tiny p-button-text"
                                    data-testid="events-table-to-edit"
                                    v-tooltip.top="'Update'"
                                    :disabled="store.disable_edit_button===true"
                                    v-if="store.hasPermission(store.assets.permission,'events-can-manage-events')
                                   ||store.hasPermission(store.assets.permission,'events-can-update-events')"
                                    @click="store.toEdit(prop.data)"
                                    icon="pi pi-pencil"/>
                        </div>


                       <div v-if="store.isViewLarge() && !prop.data.deleted_at">
                           <Button class="p-button-tiny p-button-danger p-button-text"
                                   data-testid="events-table-action-trash"
                                   v-if="store.hasPermission(store.assets.permission,'events-can-manage-events')
                                   ||store.hasPermission(store.assets.permission,'events-can-delete-events')"
                                   @click="store.itemAction('trash', prop.data)"
                                   v-tooltip.top="'Trash'"
                                   icon="pi pi-trash"/>
                       </div>


                        <Button class="p-button-tiny p-button-success p-button-text"
                                data-testid="events-table-action-restore"
                                v-if="store.isViewLarge() && prop.data.deleted_at"
                                @click="store.itemAction('restore', prop.data)"
                                v-tooltip.top="'Restore'"
                                icon="pi pi-replay"/>


                    </div>

                </template>


            </Column>


        </DataTable>
        <!--/table-->

        <!--paginator-->
        <Paginator v-model:rows="store.query.rows"
                   :totalRecords="store.list.total"
                   @page="store.paginate($event)"
                   :rowsPerPageOptions="store.rows_per_page"
                   class="bg-white-alpha-0 pt-2">
        </Paginator>
        <!--/paginator-->

    </div>

</template>
