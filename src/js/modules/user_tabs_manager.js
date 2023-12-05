/* eslint-disable no-unused-vars */
import { Tabs } from 'flowbite';

const tabsElementUser = document.getElementById('user-tabs');

// create an array of objects with the id, trigger element (eg. button), and the content element
const tabElementsUser = [
    {
        id: 'booking-tab',
        triggerEl: document.querySelector('#booking-tab'),
        targetEl: document.querySelector('#booking-content'),
    },
    {

        id: 'history-tab',
        triggerEl: document.querySelector('#history-tab'),
        targetEl: document.querySelector('#history-content'),

    },
];

// options with default values
const optionsUser = {
    defaultTabId: 'booking-tab',
    activeClasses:
        'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
    inactiveClasses:
        'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
    onShow: () => {
        console.log('tab is shownu');
    },
};

// instance options with default values
const instanceOptionsUser = {
    id: 'user-tabs',
    override: true
};

/*
* tabElements: array of tab objects
* options: optional
* instanceOptions: optional
*/
const userTabs = new Tabs(tabsElementUser, tabElementsUser, optionsUser, instanceOptionsUser);
// userTabs.show('booking-tab');


