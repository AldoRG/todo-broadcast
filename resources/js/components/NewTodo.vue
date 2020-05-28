<template>
    <div>
        <span class="new-todo-error" v-if="error">Please add a task title</span>
        <input dusk="todo-input" type="text" v-model="newTodo.title"
               @keyup.enter="addTodo" autofocus="autofocus"
               placeholder="What are you trying to get done?" class="new-todo">
    </div>
</template>
<script>
    import { mapGetters } from "vuex";
    export default {
        name: "NewTodo",
        data() {
            return {
                error: false
            }
        },
        methods: {
            addTodo() {
                if (!this.newTodo.title) {
                    this.error = true
                } else {
                    this.$store.dispatch("ADD_TODO", this.newTodo);
                }
            }
        },
        computed: {
            ...mapGetters(["newTodo"])
        }
    };
</script>
