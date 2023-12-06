/* eslint-disable no-unused-vars */

function showUserHistory(userId) {
    // Fetch user history using AJAX
    fetch(`get_user_history.php?id=${userId}`)
        .then(response => response.json())
        .then(data => {
            // Update the content of the history div
            const historyContent = document.getElementById('history-content');
            const orderedList = document.createElement('ol');
            historyContent.innerHTML = ''; // Clear previous content

            if (data.history) {
                const historyItems = data.history.split('\n').filter(item => item.trim() !== '');

                historyItems.forEach(item => {
                    const listItem = document.createElement('li');
                    listItem.classList.add(
                        'py-2', 'px-4', 'border-b', 'dark:border-gray-700', 'hover:bg-gray-50', 'dark:hover:bg-gray-600', 'dark:text-white'
                    );
                    listItem.textContent = item;
                    orderedList.classList.add('list-decimal', 'list-inside', 'pl-5', 'dark:text-white');
                    orderedList.appendChild(listItem);
                });
                historyContent.append(orderedList);
            } else {
                historyContent.innerHTML = '<li class="py-2 px-4  dark:border-gray-700   dark:text-white">No history available.</li>';
            }

            // Show the history div
            historyContent.classList.remove('hidden');
        })
        .catch(error => console.error("Error fetching user history:", error));
}
