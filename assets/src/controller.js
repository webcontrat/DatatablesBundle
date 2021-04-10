'use strict';

import { Controller } from 'stimulus';
import $ from 'jquery';
import 'datatables';

export default class extends Controller {
    static targets = ['sgdatatable'];

    connect() {
        console.log("DatatablesBundle controller connect()");

        // todo: use the column data attribute
        let columnsJson = JSON.parse(this.sgdatatableTarget.getAttribute('data-column-options'));

        let colsArray = [];
        columnsJson['columns'].forEach(function (column) {
            colsArray.push(
                {
                    title: column['dql'],
                    data: column['dql']
                }
            )
        });

        $(this.sgdatatableTarget).DataTable( {
            columns: colsArray
        } );
    }
}
