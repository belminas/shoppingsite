document.addEventListener('DOMContentLoaded', () => {
    const monitorCheckboxInput = document.querySelector('#monitor');
    const prebuildCheckboxInput = document.querySelector('#prebuilds');
    const notebookCheckboxInput = document.querySelector('#notebooks');
    const postsContainer = document.getElementById('postsContainer');

    // Grabbing sections that could be shown/hidden based on checkbox state
    const monitorSections = [document.querySelector('.monitor-rez'), document.querySelector('.monitor-dis'), document.querySelector('.monitor-pan'), document.querySelector('.monitor-ref'), document.querySelector('.monitor-res')];
    const prebuildNotebooksSections = document.querySelectorAll('.prebuild-notebooks-pro, .prebuild-notebooks-gra, .prebuild-notebooks-mem, .prebuild-notebooks-sto, .prebuild-notebooks-os');
    const notebookDisplaySection = document.querySelector('.notebooks-dis');

    // Function to toggle the visibility based on a checkbox change
    function toggleCheckboxVisibility() {
        const isAnyCheckboxChecked = monitorCheckboxInput.checked || prebuildCheckboxInput.checked || notebookCheckboxInput.checked;
        

        if (!isAnyCheckboxChecked) {
            resetAllFilters(); // Reset filters if no checkboxes are checked
        } else {
            // Apply specific visibility rules when checkboxes are checked
            monitorSections.forEach(section => section.classList.toggle('hidden-checkbox', !monitorCheckboxInput.checked));
            prebuildNotebooksSections.forEach(section => section.classList.toggle('hidden-checkbox', !(prebuildCheckboxInput.checked || notebookCheckboxInput.checked)));
            notebookDisplaySection.classList.toggle('hidden-checkbox', !notebookCheckboxInput.checked);

            // Hide the other two checkboxes and add the "hidden-checkbox" class
            if (monitorCheckboxInput.checked) {
                prebuildCheckboxInput.checked = false;
                notebookCheckboxInput.checked = false;
                prebuildCheckboxInput.parentNode.classList.add('hidden-checkbox');
                notebookCheckboxInput.parentNode.classList.add('hidden-checkbox');
                applyTitleFilter("monitor");
            } else if (prebuildCheckboxInput.checked) {
                monitorCheckboxInput.checked = false;
                notebookCheckboxInput.checked = false;
                monitorCheckboxInput.parentNode.classList.add('hidden-checkbox');
                notebookCheckboxInput.parentNode.classList.add('hidden-checkbox');
                
                // Show products with "prebuild" in the post title
                applyTitleFilter("prebuild");
            } else if (notebookCheckboxInput.checked) {
                monitorCheckboxInput.checked = false;
                prebuildCheckboxInput.checked = false;
                monitorCheckboxInput.parentNode.classList.add('hidden-checkbox');
                prebuildCheckboxInput.parentNode.classList.add('hidden-checkbox');

                // Show products with "notebooks" in the post title
                applyTitleFilter("notebook");
            }
        }
    }

    function resetAllFilters() {
        const allPosts = postsContainer.querySelectorAll('.resolution-post');
        allPosts.forEach(post => post.style.display = 'block'); // Show all posts

        // Optionally, reset the state of checkboxes if necessary
        [monitorCheckboxInput, prebuildCheckboxInput, notebookCheckboxInput].forEach(checkbox => {
            checkbox.checked = false;
            checkbox.parentNode.classList.remove('hidden-checkbox'); // Remove the "hidden-checkbox" class
        });
    }

    function toggleMonitorSections(isChecked) {
        monitorSections.forEach(section => {
            if (isChecked) {
                section.classList.remove('hidden-checkbox');
            } else {
                section.classList.add('hidden-checkbox');
            }
        });
    }

    function toggleSections() {
        // Check if either prebuild or notebook checkboxes are checked
        const anyChecked = prebuildCheckboxInput.checked || notebookCheckboxInput.checked;

        // Toggle visibility for common sections
        prebuildNotebooksSections.forEach(section => {
            if (anyChecked) {
                section.classList.remove('hidden-checkbox');
            } else {
                section.classList.add('hidden-checkbox');
            }
        });

        // Toggle visibility for notebook-specific section
        if (notebookCheckboxInput.checked) {
            notebookDisplaySection.classList.remove('hidden-checkbox');
        } else {
            notebookDisplaySection.classList.add('hidden-checkbox');
        }
    }
    

    function handleCheckboxGroupChange(checkboxGroupClass) {
        const checkboxGroup = document.querySelectorAll(`.${checkboxGroupClass}`);
        checkboxGroup.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    // Hide all other checkboxes in the same group except the one that was just checked
                    checkboxGroup.forEach(otherCheckbox => {
                        if (otherCheckbox !== checkbox) {
                            otherCheckbox.parentNode.style.display = 'none';
                        }
                    });
                } else {
                    // If the checkbox was unchecked, show all checkboxes in the group again
                    checkboxGroup.forEach(otherCheckbox => {
                        otherCheckbox.parentNode.style.display = 'block';
                    });
                }
            });
        });
    }

    // Add event listeners
    [prebuildCheckboxInput, notebookCheckboxInput].forEach(checkbox => {
        checkbox.addEventListener('change', toggleSections);
    });

    // Initial check to set correct state based on pre-checked conditions
    toggleSections();
    handleCheckboxGroupChange('resolution-checkbox');
    handleCheckboxGroupChange('display-checkbox');
    handleCheckboxGroupChange('panel-checkbox');
    handleCheckboxGroupChange('refresh-checkbox');
    handleCheckboxGroupChange('response-checkbox');
    handleCheckboxGroupChange('processor-checkbox');
    handleCheckboxGroupChange('graphics-checkbox');
    handleCheckboxGroupChange('memory-checkbox');
    handleCheckboxGroupChange('storage-checkbox');
    handleCheckboxGroupChange('os-checkbox');


    // Event listener for monitor checkbox
    monitorCheckboxInput.addEventListener('change', () => {
        toggleMonitorSections(monitorCheckboxInput.checked);
    });

    // Initial check in case the monitor checkbox is pre-checked when the page loads
    toggleMonitorSections(monitorCheckboxInput.checked);

    // Add event listeners to all checkboxes
    [monitorCheckboxInput, prebuildCheckboxInput, notebookCheckboxInput].forEach(checkbox => {
        checkbox.addEventListener('change', toggleCheckboxVisibility);
    });

    function applyTitleFilter(keyword) {
        const posts = postsContainer.querySelectorAll('.resolution-post');
        posts.forEach((post) => {
            const title = post.querySelector('.fw-bold.text-dark').textContent.toLowerCase();
            const hasKeywordInTitle = title.includes(keyword);

            // Set post visibility based on the keyword in the title
            post.style.display = hasKeywordInTitle ? 'block' : 'none';
        });
    }

    [monitorCheckboxInput, prebuildCheckboxInput, notebookCheckboxInput].forEach(checkbox => {
        checkbox.addEventListener('change', toggleCheckboxVisibility);
    });

    // Initial calls to set up the page state based on current checkbox states
    toggleCheckboxVisibility(); // Ensures the initial state respects the monitor checkbox status

    const checkboxGroups = {
        resolution: document.querySelectorAll('.resolution-checkbox'),
        category: document.querySelectorAll('.category-checkbox'),
        display: document.querySelectorAll('.display-checkbox'),
        panel: document.querySelectorAll('.panel-checkbox'),
        refresh: document.querySelectorAll('.refresh-checkbox'),
        response: document.querySelectorAll('.response-checkbox'),
        processor: document.querySelectorAll('.processor-checkbox'),
        graphics: document.querySelectorAll('.graphics-checkbox'),
        memory: document.querySelectorAll('.memory-checkbox'),
        storage: document.querySelectorAll('.storage-checkbox'),
        os: document.querySelectorAll('.os-checkbox')
    };
    let hiddenCheckboxes = [];

    function resetCheckboxes(checkboxes) {
        console.log("resetCheckboxes called"); // Debugging line
        checkboxes.forEach(checkbox => {
            if (!['monitor', 'prebuilds', 'notebooks'].includes(checkbox.id)) {
                console.log(`Resetting ${checkbox.id}`); // Debugging line
                checkbox.checked = false;
            }
            checkbox.parentNode.style.display = 'block';
        });
    }

    function applyFilters() {
        const selectedFilters = {};
        const visiblePostIds = []; // Array to hold IDs of visible posts
    
        Object.entries(checkboxGroups).forEach(([groupName, checkboxes]) => {
            selectedFilters[groupName] = Array.from(checkboxes)
                .filter((checkbox) => checkbox.checked)
                .map((checkbox) => checkbox.value);
        });
    
        // Adjusts display of each post based on whether it matches the selected filters.
        const posts = postsContainer.querySelectorAll('.resolution-post');
        posts.forEach((post) => {
            const tags = post.getAttribute('data-resolution-tags');
            const description = post.querySelector('.fw-bold.text-dark').textContent.toLowerCase();
            const isVisible = Object.entries(selectedFilters).every(([groupName, selectedValues]) => {
                return selectedValues.length === 0 || selectedValues.some((value) => tags.includes(value)) ||
                    (groupName === 'display' && selectedFilters.response.some((responseValue) => description.includes(responseValue)));
            });
    
            if (isVisible) {
                post.style.display = 'block';
                visiblePostIds.push(post.dataset.id); // Assuming each post has a data-id attribute
            } else {
                post.style.display = 'none';
            }
        });
    
        // Log the array of visible post IDs to the console for debugging
        console.log(visiblePostIds);
    }

    // Hides checkboxes that have no matching posts, simplifying the filter interface for the user.
    function hideUnmatchedCheckboxes() {
        Object.entries(checkboxGroups).forEach(([groupName, checkboxes]) => {
            checkboxes.forEach((checkbox) => {
                const value = checkbox.value;
                const isMatched = Array.from(postsContainer.querySelectorAll('.resolution-post'))
                    .some((post) => post.getAttribute('data-resolution-tags').includes(value));
                checkbox.parentNode.style.display = isMatched ? 'block' : 'none';
            });
        });
    }

    // Initial call to ensure unmatched checkboxes are hidden when the page loads.
    hideUnmatchedCheckboxes();

    // Adds change listeners to all checkboxes to apply filters or reset as needed.
    Object.entries(checkboxGroups).forEach(([groupName, checkboxes]) => {
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                const checked = checkbox.checked;

                // Reset other checkboxes and reapply filters upon any checkbox change.
                if (!checked) {
                    resetCheckboxes(checkboxes);
                    applyFilters();
                } else {
                    // This block intends to hide other checkboxes when one is checked,
                    hiddenCheckboxes = [];
                    checkboxes.forEach((otherCheckbox) => {
                        if (otherCheckbox !== checkbox && !otherCheckbox.checked) {
                            otherCheckbox.parentNode.style.display = 'none';
                            hiddenCheckboxes.push(otherCheckbox.parentNode);
                        }
                    });
                    applyFilters();
                }
            });
        });
    });
});



