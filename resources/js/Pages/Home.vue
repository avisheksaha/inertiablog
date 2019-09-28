<template>
    <layout>
        <div class="max-w-5xl mx-auto px-4 py-10">
            <card v-for="post in posts" :key="post.uuid" class="mb-10">
                <div class="flex">
                    <div class="w-64 mr-5 rounded-lg bg-gray-100">
                        <img :src="post.image_full_path" class="object-cover rounded-lg w-full h-full" />
                    </div>
                    <div>
                        <heading size="heading" class="mb-2"><inertia-link :href="`/post/${post.id}/show`">{{post.title}}</inertia-link></heading>
                        <heading class="mb-6">{{post.summary}}</heading>
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <div>
                                    <avatar :name="post.user.name" color="blue" class="mr-3"></avatar>
                                </div>
                                <heading>{{post.user.name}}</heading>
                            </div>
                            <div class="mx-4 text-gray-600">&bull;</div>
                            <div>
                                <a href="#" class="text-blue-600">{{post.category.category_name}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </card>
        </div>
    </layout>
</template>
<script>
import Layout from "@/Shared/Layout";
import Card from "@/Shared/tuis/Card";
import Avatar from "@/Shared/tuis/Avatar";
import Heading from "@/Shared/tuis/Heading";
import BasicTable from "@/Shared/tuis/BasicTable";
import Badge from "@/Shared/tuis/Badge";
import Alert from "@/Shared/tuis/Alert";
export default {
    components: {
        Layout,
        Card,
        Heading,
        BasicTable,
        Badge,
        Alert,
        Avatar
    },
    props: ["posts"],
    data() {
        return {
            showNavbar: false
        };
    }
};
</script>
<style>
.active {
    position: relative;
}
.active:after {
    bottom: 0;
    position: absolute;
    left: 0;
    right: 0;
    display: block;
    margin-left: auto;
    margin-right: auto;
    content: "";
    height: 3px;
    width: 100%;
    border-radius: 1000px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
    background-color: #4299e1; /* Change this color a/c to theme */
}
</style>
