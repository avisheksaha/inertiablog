<template>
    <div>
        <layout>
            <div class="lg:my-4 bg-green-300">
                <div class="mx-auto w-64 rounded-lg bg-red-200">
                    <img :src="post.image_full_path" class="object-cover rounded-lg w-full h-full" />
                </div>
            </div>
        </layout>
    </div>
</template>

<script>
import Layout from "@/Shared/Layout";

    export default {
        components: {
            Layout
        },
        props: [
            "post"
        ]
    }
</script>

<style lang="scss" scoped>

</style>