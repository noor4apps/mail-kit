<script>
export default {
    name: 'SequenceMailList',
    props: {
        mails: {
            type: Array,
            required: true,
        },
        select: Object
    },
}
</script>
<template>
    <div class="sm:px-6 lg:px-8">
        <div v-for="mail in mails" :key="mail.id" @click="$emit('selected', mail)" :class="[{ 'bg-green-400': mail.id === select.id }]" class="p-6 w-52 max-w-sm mx-auto shadow-md hover:cursor-pointer hover:bg-gray-50 mb-4">
            <p class="text-white-700">{{ mail.subject }}</p>
        </div>
        <div class="w-52 max-w-sm mx-auto">
            <button @click="$emit('mail-added')" class="w-full bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" type="button">
                Add E-Mail
            </button>
        </div>
    </div>
</template>
