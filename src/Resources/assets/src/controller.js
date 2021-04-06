'use strict';

import { Controller } from 'stimulus';
import $ from 'jquery';
import 'datatables';

export default class extends Controller {
    static targets = ['sgdatatable'];

    connect() {
        console.log("Connect");

        $(this.sgdatatableTarget).DataTable( {
            scrollY: 300,
            paging: false
        } );
    }
}
