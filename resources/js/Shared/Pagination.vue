<template>
    <div>
         <Component v-for="l in links.links" :key="l" :is="!l.active ? 'Link' :'span'" class="px-2 py-1" :class="!l.active ? '' : 'text-gray-500 cursor-pointer'" :href="l.url" v-html="l.label" />
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3"
export default {
    components:{
        Link
    },  
    props:{
        links:Object
    }
}
</script>