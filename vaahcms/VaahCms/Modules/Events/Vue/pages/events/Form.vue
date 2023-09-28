<script setup>
import {onMounted, ref, watch} from "vue";
import { useEventsStore } from '../../stores/store-events'

import VhField from './../../vaahvue/vue-three/primeflex/VhField.vue'
import {useRoute} from 'vue-router';


const store = useEventsStore();
const route = useRoute();

onMounted(async () => {
    if(route.params && route.params.id)
    {
        await store.getItem(route.params.id);
    }
    if(route.params && route.query.manager_id)
    {
        await store.managerId(route.query.manager_id);
    }
    await store.getFormMenu();
});
const a=5;
//--------form_menu
const form_menu = ref();
const toggleFormMenu = (event) => {
    form_menu.value.toggle(event);
};
//--------/form_menu

</script>
<template>

    <div class="col-6" >
        <Panel class="is-small">

            <template class="p-1" #header>

                <div class="flex flex-row">
                    <div class="p-panel-title">
                        <span v-if="store.item && store.item.id">
                            Update
                        </span>
                        <span v-else>
                            Create
                      </span>
                    </div>

                </div>


            </template>

            <template #icons>


                <div class="p-inputgroup">
                    <Button label="Save"
                            class="p-button-sm"
                            v-if="store.item && store.item.id"
                            data-testid="events-save"
                            @click="store.itemAction('save')"
                            icon="pi pi-save"/>

                    <Button label="Create & New"
                            v-else
                            @click="store.itemAction('create-and-new')"
                            class="p-button-sm"
                            data-testid="events-create-and-new"
                            icon="pi pi-save"/>


                    <!--form_menu-->
                    <Button
                        type="button"
                        @click="toggleFormMenu"
                        class="p-button-sm"
                        data-testid="events-form-menu"
                        icon="pi pi-angle-down"
                        aria-haspopup="true"/>

                    <Menu ref="form_menu"
                          :model="store.form_menu_list"
                          :popup="true" />
                    <!--/form_menu-->


                    <Button class="p-button-primary p-button-sm"
                            icon="pi pi-times"
                            data-testid="events-to-list"
                            @click="store.toList()">
                    </Button>
                </div>



            </template>


            <div v-if="store.item" class="pt-2">

                <VhField label="Event Name">
                    <InputText class="w-full"
                               name="events-name"
                               data-testid="events-name"
                               @update:modelValue="store.watchItem"
                               v-model="store.item.name"/>
                </VhField>
                <VhField label="Slug">
                    <InputText class="w-full"
                               name="events-slug"
                               data-testid="events-slug"
                               v-model="store.item.slug"
                    disabled=""/>
                </VhField>
                <VhField label="Category" >
                    <Dropdown v-model="store.item.categories"
                              :options="store.assets.category"
                              optionLabel="name"
                              optionValue="id"
                              placeholder="Select a category"
                              class="w-full md:w-18.5rem h-2rem"  />
                </VhField>

                <VhField label="Location">
                    <InputText class="w-full"
                               name="events-location"
                               data-testid="events-location"
                               v-model="store.item.location"/>
                </VhField>
                    <VhField label="Manager">
                    <Dropdown v-model="store.item.managers"
                              :options="store.assets.manager"
                              optionLabel="name"
                              optionValue="id"
                              placeholder="Select a Manager"
                              class="w-full md:w-18.5rem h-2rem"  />
                </VhField>



                <VhField label="Dates">
                    <Calendar v-model="store.item.date" showIcon class="w-full"   />

                </VhField>



                <VhField label="Is Active">
                    <InputSwitch v-bind:false-value="0"
                                 v-bind:true-value="1"
                                 class="p-inputswitch-sm"
                                 name="events-active"
                                 data-testid="events-active"
                                 v-model="store.item.is_active"/>
                </VhField>

            </div>
        </Panel>

    </div>

</template>
