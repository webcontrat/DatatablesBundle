'use strict';

import { Controller } from 'stimulus';
import $ from 'jquery';
import 'datatables';

export default class extends Controller {
    static targets = ['sgdatatable'];

    connect() {
        console.log("DatatablesBundle connect()");

        // A global controller is currently in use. See asset folder in the Sandbox.
    }
}
