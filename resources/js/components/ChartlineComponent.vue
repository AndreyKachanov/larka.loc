<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="chartjs">
                    <b-table
                            id="table-transition-example"
                            :fields="fields"
                            :items="items"
                            striped
                            small
                            :primary-key="firstCell"
                            :tbody-transition-props="transProps"
                    ></b-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['fields', 'items'],

        data: function () {
            return {
                // dataForChartJs: this.data,
                firstCell: 'Єдиний унікальний номер справи',
                fieldsForTable: [
                    { key: 'age', sortable: true },
                    { key: 'last_name', sortable: true },
                    { key: 'first_name', sortable: true },
                    { key: 'isActive', sortable: true }
                ],
                itemsForTable: [
                    { age: 40, isActive: true,  first_name: 'Dickerson', last_name: 'Macdonald' },
                    { age: 21, isActive: false,  first_name: 'Larsen', last_name: 'Shaw' },
                    { age: 89, isActive: false,  first_name: 'Geneva', last_name: 'Wilson' },
                    { age: 38, isActive: true,  first_name: 'Jami', last_name: 'Carney' }
                ],
                transProps: {
                    // Transition name
                    name: 'flip-list'
                }
            };
        },
    }
</script>
