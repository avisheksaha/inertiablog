<template>
    <div>
        <layout>
        <div class="flex mx-auto">
            <div class="w-3/5">
                <heading size="heading" class="mb-4">Public Profile</heading>
                <hr>
                <text-input label="Name" v-model="form.name" class="mt-4"></text-input>
                <small class="text-gray-700">Your name may appear around OurBlog where you post or are mentioned. You can remove it at any time.</small>

                <text-input label="Public Email" v-model="form.email" class="mt-4"></text-input>
                <small class="text-gray-700">
                    You have set your email address to private. To toggle email privacy, go to email settings and uncheck "Keep my email address private."
                </small>

                <textarea-input label="Bio" v-model="form.bio" class="mt-4 font-bold text-gray-700" placeholder="Tell us a little bit about yourself"></textarea-input>

                <text-input label="URL" v-model="form.url" class="mt-4"></text-input>

                <text-input label="Location" v-model="form.location" class="mt-4"></text-input>
                <small class="text-gray-700">You can share your location from where you belongs</small>

                <div class="my-5"><loading-button @click.prevent="createProfile" class="tracking-wider bg-green-400" variant="success">Update</loading-button></div>
            </div>
            <div class="w-2/5 pl-12 mt-16">
                <file-input label="Profile picture"></file-input>
            </div>
        </div>
        <div class="flex mx-auto my-6">
            <div class="w-3/5">
                <h1 class="text-3xl text-gray-700 py-4">Change Password</h1>
                <hr />
                <div class="my-4">
                    <text-input v-model="resetform.current_password" label="Current Password" :errors="errors.current_password"></text-input>
                </div>
                <div class="my-4">
                    <text-input v-model="resetform.password" label="New Password" :errors="errors.password"></text-input>
                </div>
                <div class="my-4">
                    <text-input v-model="resetform.password_confirmation" label="Confirm New Password" :errors="errors.password_confirmation"></text-input>
                </div>
                <div class="my-4">
                    <loading-button @click="changePassword">Change Password</loading-button>
                </div>
            </div>
            <div class="w-2/5"></div>
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
                    form: {
                        name: this.user.name,
                        email: this.user.email,
                        bio: this.profile ? this.profile.bio : null,
                        url: this.profile ? this.profile.url : null,
                        location: this.profile ? this.profile.location : null
                    },

                    resetform: {
                        current_password: "",
                        password: "",
                        password_confirmation: ""
                    }
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
            },

            props: ["errors", "user", "profile"],

            methods: {
                changePassword() {
                    this.$inertia
				        .post("/changePassword", this.resetform)
				        .then(res => {
					        // this.$refs.submitButton.stopLoading();
					        this.resetform = {};
				        })
				        .catch(() => {
					        // this.$refs.submitButton.stopLoading();
				        });
                },
                createProfile(){
                    this.$inertia
				        .post("/profile/create", this.form)
				        .then(res => {
					        // this.$refs.submitButton.stopLoading();
				        })
				        .catch(() => {
					        // this.$refs.submitButton.stopLoading();
				        });
                }
            }
    }
</script>

<style lang="scss" scoped>

</style>