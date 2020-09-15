/*
 * Copyright 2020 LABOR.digital
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * Last modified: 2020.08.24 at 19:23
 */

import "./css/admin.sass"

const $ = window.jQuery;

/**
 * Toggles the fields in the site settings module
 */
$(function(){

    const $selectBox = $('select[name=snippetType]');

    function calculateFieldVisibility() {
        const $defaultFields = $('.fieldToggle.fieldToggle--default');
        const val = $selectBox.val();

        $defaultFields.hide();

        if(val === 'calcAnnuityWhiteLabel'){
            $defaultFields.show();
        }
    }

    $selectBox.bind('change', function(){
        calculateFieldVisibility();
    });
    calculateFieldVisibility();
});
