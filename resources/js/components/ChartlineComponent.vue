<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="chartjs">
                    <b-table
                            id="table-transition-example"
                            :fields="fieldsForTable"
                            :items="itemsForTable"
                            striped
                            small
                            :primary-key="primaryKey"
                            :tbody-transition-props="transProps"
                    >
                        <template v-slot:cell(Зал)="row">
                            <b-form-input v-on:change="changeRoomNumber($event, row.item)" v-model="row.item.Зал"/>
                        </template>

                    </b-table>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['fields', 'items'],

        data() {
            return {
                // dataForChartJs: this.data,
                primaryKey: 'Сторони по справі',
                fieldsForTable: this.fields,
                itemsForTable: this.items,
                transProps: {
                    // Transition name
                    name: 'flip-list'
                }
            };
        },

        methods: {
            changeRoomNumber(e, item){
                console.log(item);
            },
        }
    }
</script>
