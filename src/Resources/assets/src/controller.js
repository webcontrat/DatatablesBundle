'use strict';

import { Controller } from 'stimulus';
import $ from 'jquery';
import 'datatables';

export default class extends Controller {
    static targets = ['sgdatatable'];

    connect() {
        console.log("DatatablesBundle connect()");

        // A global controller is currently in use. See asset folder in the Sandbox.
        // It is therefore possible that the version available here is not up to date

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
