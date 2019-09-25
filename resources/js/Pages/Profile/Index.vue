<template>
    <div>
        <layout>
        <div class="flex mx-auto">
            <div class="w-3/5">
                <heading size="heading" class="mb-4">Public Profile</heading>
                <hr>
                <text-input label="Name" class="mt-4"></text-input>
                <small class="text-gray-700">Your name may appear around OurBlog where you post or are mentioned. You can remove it at any time.</small>
                <text-input label="Public Email" class="mt-4"></text-input>
                <small class="text-gray-700">
                    You have set your email address to private. To toggle email privacy, go to email settings and uncheck "Keep my email address private."
                </small>
                <textarea-input label="Bio" class="mt-4 font-bold text-gray-700" placeholder="Tell us a little bit about yourself"></textarea-input>
                <text-input label="URL" class="mt-4"></text-input>
                <text-input label="Location" class="mt-4"></text-input>
                <small class="text-gray-700">You can share your location from where you belongs</small>
                <div class="my-5"><loading-button class="tracking-wider bg-green-400" variant="success">Update</loading-button></div>
            </div>
            <div class="w-2/5 pl-12 mt-16">
                <file-input label="Profile picture"></file-input>
            </div>
        </div>
        </layout>
    </div>
</template>

<script>
    import Layout from "@/Shared/Layout";
    import TextInput from "@/Shared/tuis/TextInput";
    import Card from "@/Shared/tuis/Card";
    import Heading from "@/Shared/tuis/Heading";
    import TextareaInput from "@/Shared/tuis/TextareaInput";
    import LoadingButton from "@/Shared/tuis/LoadingButton";
    import FileInput from "@/Shared/tuis/FileInput";

    export default {
            data () {
                return {

                }
            },
            
            components: {
                Layout,
                TextInput,
                Card,
                Heading,
                TextareaInput,
                LoadingButton,
                FileInput
            }
    }
</script>

<style lang="scss" scoped>

</style>