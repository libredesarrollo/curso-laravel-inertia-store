<template>
    <app-layout>
        
        <Link :href="route('category.create')">Create</Link>

        <table class="w-full">
            <thead>
                <th class="p-3">Id</th>
                <th class="p-3">Title</th>
                <th class="p-3">Slug</th>
                <th class="p-3">Actions</th>
            </thead>
            <tbody>
                <tr v-for="c in categories.data" :key="c.id">
                    <td class="p-2">{{ c.id }}</td>
                    <td class="p-2">{{ c.title }}</td>
                    <td class="p-2">{{ c.slug }}</td>
                    <td class="p-2">
                        <Link :href="route('category.edit',c.id)">Edit</Link>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- <template v-for="l in categories.links" :key="l">
            <Link v-if="!l.active" class="px-2 py-1" :href="l.url" v-html="l.label"/>
            <span v-else class="px-2 py-1 cursor-pointer text-gray-500"  v-html="l.label"  />
        </template> -->

       <pagination :links="categories" />
        

    </app-layout>
</template>

<script>

import { Link } from "@inertiajs/inertia-vue3"
import AppLayout from "@/Layouts/AppLayout"
import Pagination from '@/Shared/Pagination.vue'

export default {
    components:{
        AppLayout,
        Link, 
        Pagination
    },
    props:{
        categories: Object
    }
}
</script>
