/* eslint-disable no-unused-vars */
import { Tabs } from 'flowbite';

const tabsElementAdmin = document.getElementById('admin-tabs');

// create an array of objects with the id, trigger element (eg. button), and the content element
const tabElementsAdmin = [
    {
        id: 'approve-reservations-tab',
        triggerEl: document.querySelector('#approve-reservations-tab'),
        targetEl: document.querySelector('#approve-reservations-content'),
    },
    {
        id: 'approve-attendance-tab',
        triggerEl: document.querySelector('#approve-attendance-tab'),
        targetEl: document.querySelector('#approve-attendance-content'),
    },

    {
        id: 'admin-history-tab',
        triggerEl: document.querySelector('#admin-history-tab'),
        targetEl: document.querySelector('#admin-history-content'),
    },
];

// options with default values
const optionsAdmin = {
    defaultTabId: 'settings',
    activeClasses:
        'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
    inactiveClasses:
        'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
    onShow: () => {
        console.log('tab is shown');
    },
};

// instance options with default values
const instanceOptionsAdmin = {
    id: 'admin-tabs',
    override: true
};

/*
* tabElements: array of tab objects
* options: optional
* instanceOptions: optional
*/
const adminTabs = new Tabs(tabsElementAdmin, tabElementsAdmin, optionsAdmin, instanceOptionsAdmin);
// adminTabs.show('approve-reservations-tab');


