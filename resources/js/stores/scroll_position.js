import { defineStore } from "pinia"

export const use_scroll_position_store = defineStore('scroll_position', {
	state: () => ({
		last_value: 0
	}),

	actions: {
		set_last_value (val) {
			this.last_value = val
		}
	}
})