'use strict';

import { Controller } from 'stimulus';
import $ from 'jquery';
import moment from 'moment';

export default class extends Controller {
    static targets = ['sgmoment'];

    connect() {
        console.log('Moment controller connect()');

        let format = this.sgmomentTarget.getAttribute('data-format');

        $(this.sgmomentTarget).html(function(index, value) {
            return moment(value).format(format);
        });
    }
}
