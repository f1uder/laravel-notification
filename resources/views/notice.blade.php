<div class="notification {{ 'notice-position-' . $position }}"
     x-data="notification()"
     x-init="render()"
     @notice.window="add($event.detail)">

    <template x-for="notice in list" :key="notice.id">
        <div x-bind:class="'widget notice-' + notice.type"
             role="alert"
             x-show="notices.includes(notice)"
             x-transition:enter="transition ease-in duration-200"
             x-transition:enter-start="transform opacity-0 translate-y-2"
             x-transition:enter-end="transform opacity-100"
             x-transition:leave="transition ease-out duration-500"
             x-transition:leave-start="transform translate-x-0 opacity-100"
             x-transition:leave-end="transform translate-x-full opacity-0">
            <button x-on:click="remove(notice.id)" type="button" class="notice-button">
                <span class="sr-only">Close</span>
                <svg class="close-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z" fill="currentColor"></path>
                </svg>
            </button>
            <div class="flex items-center p-3">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1 icon" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                    </svg>
                </div>
                <div class="mx-3">
                    <h3 x-show="notice.title" class="title font-medium" x-text="notice.title ?? null"></h3>
                    <div class="text-sm description" x-text="notice.message"></div>
                </div>
            </div>
        </div>
    </template>

    <script>
        function notification() {
            return {
                list: [],
                notices: [],
                notice: {},
                timer: {{ $timer }},

                add(notice) {
                    notice.id = this.uuid;
                    const timer = notice.hasOwnProperty('timer') ? notice.timer : this.timer;
                    this.list.push(notice);
                    this.initNotice(notice.id, timer);
                },

                initNotice(id, timer) {
                    this.notices.push(this.list.find(notice => notice.id === id));
                    const timeShown = timer + (this.notices.length * 1000);
                    setTimeout(() => {
                        this.remove(id);
                    }, timeShown);
                },

                render() {
                    let notices = @js($notices);
                    let i = notices.length;
                    while (i--) {
                        this.add(notices[i]);
                    }
                },

                remove(id) {
                    const notice = this.notices.find(notice => notice.id === id);
                    const index = this.notices.indexOf(notice);
                    this.notices.splice(index, 1);
                },

                get uuid() {
                    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, c => {
                        const r = parseFloat(`0.${Math.random().toString().replace('0.', '')}${new Date().getTime()}`) * 16 | 0;
                        const v = c === 'x' ? r : r & 0x3 | 0x8;

                        return v.toString(16);
                    });
                },
            }
        }
    </script>
</div>
