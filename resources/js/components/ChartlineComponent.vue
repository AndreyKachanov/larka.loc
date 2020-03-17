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
        props: ['fields', 'items', 'route_room_number'],

        data() {
            return {
                // dataForChartJs: this.data,
                primaryKey: 'key',
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
                // let obj = {};
                // obj['item'] = item;
                axios.post(this.route_room_number, item).then((response) => {
                    console.log(response);
                    // setTimeout(() => loader.hide(), 1200);
                    // this.errors = [];
                }).catch(error => {
                    // loader.hide();
                    // this.errors = error.response.data.errors;
                    // if (typeof this.errors.keywords !== 'undefined') {
                    //     if (this.radio_keywords === 'buy')  {
                    //         this.error_keywords_buy = true;
                    //         this.error_keywords_sale = false;
                    //     } else {
                    //         this.error_keywords_sale = true;
                    //         this.error_keywords_buy = false;
                    //     }
                    // }
                }).then(() => {});
            },
        }
    }
</script>
