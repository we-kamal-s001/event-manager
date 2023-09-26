<script setup>
import {vaah} from '../../../vaahvue/pinia/vaah'
import {useManagerStore} from '../../../stores/store-managers'

const store = useManagerStore();
const useVaah = vaah();

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
            >

                <template #body="prop">
                    <Badge v-if="prop.data.deleted_at"
                           value="Trashed"
                           severity="danger"></Badge>
                    {{prop.data.name}}
                </template>

            </Column>

            <Column field="events" header="Event(s)"
            >

                <template #body="prop" @click="store.toEvent">
                         <span class="p-inputgroup-addon" style="width:95px">
                                 <Button style="display: flex; align-items: center;"
                                         v-tooltip.top="'Event'"
                                         @click="store.toEventFilter(prop.data)">
                                                    <Tag :value="prop.data.events.length"></Tag>
                                        </Button>
                                               <Button  style="color:
                                                        white; margin-left: 8px; background-color:
                                                        darkblue; padding: 4px; border-radius: 50%;"
                                                       v-tooltip.top="'Add Event'"
                                                       icon="pi pi-plus"
                                                       @click="store.toEvent(prop.data)"></Button>
                                                   </span>


                </template>

            </Column>
            <Column field="type" header="Category"
            >

                <template #body="prop">
                    <DataTable :value="prop.data.category">
                        <Column>
                            <template #body="prop">
                                {{prop.data.get_taxonomy.name}}
                            </template>
                        </Column>
                    </DataTable>
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
                                 data-testid="managers-table-is-active"
                                 v-bind:false-value="0" v-bind:true-value="1"
                                 class="p-inputswitch-sm"
                                 @input="store.toggleIsActive(prop.data)">
                    </InputSwitch>
                </template>

            </Column>

            <Column field="actions" style="width:150px;"
                    :style="{width: store.getActionWidth() }"
                    :header="store.getActionLabel()"

            >

                <template #body="prop">
                    <div class="p-inputgroup "
                        >

                        <Button class="p-button-tiny p-button-text"
                                data-testid="managers-table-to-view"
                                v-tooltip.top="'View'"
                                v-if="store.hasPermission(store.assets.permission,'events-can-manage-events')
                                ||store.hasPermission(store.assets.permission,'events-can-view-manager')"
                                @click="store.toView(prop.data)"
                                icon="pi pi-eye"/>


                        <div v-if="prop.data.id!==store.item.id">
                            <Button class="p-button-tiny p-button-text"
                                    data-testid="events-table-to-edit"
                                    v-tooltip.top="'Update'"
                                    v-if="store.disable_edit_button!==false &&
                                    store.hasPermission(store.assets.permission,'events-can-manage-events')
                                ||store.hasPermission(store.assets.permission,'events-can-update-manager')"
                                    @click="store.toEdit(prop.data)"
                                    icon="pi pi-pencil"/>
                        </div>
                        <div v-else>
                            <Button class="p-button-tiny p-button-text"
                                    data-testid="events-table-to-edit"
                                    v-tooltip.top="'Update'"
                                    v-if="store.hasPermission(store.assets.permission,'events-can-manage-events')
                                ||store.hasPermission(store.assets.permission,'events-can-update-manager')"
                                    @click="store.toEdit(prop.data)"
                                    icon="pi pi-pencil"/>
                        </div>


                        <Button class="p-button-tiny p-button-danger p-button-text"
                                data-testid="managers-table-action-trash"
                                v-if="store.isViewLarge() && !prop.data.deleted_at && store.hasPermission(store.assets.permission,'events-can-manage-events')
                        ||store.hasPermission(store.assets.permission,'events-can-delete-manager')"
                                @click="store.itemAction('trash', prop.data)"
                                v-tooltip.top="'Trash'"
                                icon="pi pi-trash"/>


                        <Button class="p-button-tiny p-button-success p-button-text"
                                data-testid="managers-table-action-restore"
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
