<template>

</template>

<script>

    export default{
        data() {
            return {
                showDropdown: '',
            }
        },
        methods: {
            showDrop() {
                if (this.showDropdown === 'show')
                    this.showDropdown = ''
                else this.showDropdown = 'show'
            },
        },
        mounted() {
            console.log('Component principal mounted.')
        },
    }
</script>