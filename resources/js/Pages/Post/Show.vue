<template>
    <div>
        <layout>
            <div class="flex">
                <div class="w-2/3">
                    <div class="h-68 rounded-lg bg-blue-300">
                        <img :src="post.image_full_path" class="object-fill rounded-lg w-full h-full" />
                    </div>
                    <div class="py-8">
                        <p class="text-3xl">{{post.title}}</p>
                        <p>
                            <avatar :name="post.user.name" color="orange"></avatar>
                            <span class="text-sm">{{post.user.name}}</span>&nbsp;<span class="text-gray-500 text-sm">in</span>&nbsp;<span class="text-sm">{{post.category.category_name}}</span>
                        </p>
                        <p class="pt-4 text-sm text-justify tracking-widest text-gray-700 leading-relaxed">{{post.description}}</p>
                        <p class="pt-8 text-sm tracking-wider">
                            <span class="text-gray-800">Category:</span>&nbsp;<span class="text-green-400">{{post.category.category_name}}</span>
                        </p>
                    </div>
                    <div class="pt-2 pb-6">
                        <p class="text-2xl tracking-wider"><u>6 Comments</u></p>
                        <div class="py-4">
                            <textarea-input v-model="form.comment" :errors="errors.comment"
				            @keydown="delete errors.comment" placeholder="Leave a Comment"></textarea-input>
                            <div class="mt-2">
                                <loading-button ref="submitButton" @click="commentCreate">Post</loading-button>
                            </div>
                        </div>
                        <!-- {{commentDatas}} -->

                        <div class="py-6 flex" v-for="commentData in commentDatas" :key="commentData.id">
                            <div><avatar :name="post.user.name" color="orange"></avatar></div>
                            <div class="pl-4">
                                <p class="text-lg">{{commentData.user.name}}</p>
                                <p class="text-sm text-gray-500 tracking-wider uppercase py-1">{{commentData.created_at_formated}}</p>
                                <p class="text-sm tracking-wide text-gray-700 ">{{commentData.comment}}</p>
                            </div>
                            <div>
                                <text-input v-model="subform.subcomment"></text-input>
                                <button class="bg-gray-700 text-white px-4 py-1 mt-3 rounded" @click="subCommentCreate(commentData.id)">Reply</button>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="w-1/3 pl-12">
                    <div class="pb-4 text-2xl tracking-wider underline">Popular Posts</div>
                    <div class="pb-8">
                        <div class="flex">
                            <div class="text-3xl tracking-wider text-gray-400">01</div>
                            <div class="mt-2 pl-2">
                                <div class="text-lg inline-block">News Needs to Meet Its Audiences Where They Are</div>  
                                 <div class="text-sm inline-block pt-2">
                                    <span>{{post.user.name}}</span>&nbsp;<span class="text-gray-500 text-sm">in</span>&nbsp;<span class="text-sm">{{post.category.category_name}}</span>
                                    {{post.published_at_formated}}

                                </div>   
                            </div>
                        </div>   
                    </div>
                    
                    <div class="pb-8">
                        <div class="flex">
                            <div class="text-3xl tracking-wider text-gray-400">02</div>
                            <div class="mt-2 pl-2">
                                <div class="text-lg inline-block">News Needs to Meet Its Audiences Where They Are</div>  
                                 <div class="text-sm inline-block pt-2">
                                    <span>{{post.user.name}}</span>&nbsp;<span class="text-gray-500 text-sm">in</span>&nbsp;<span class="text-sm">{{post.category.category_name}}</span>
                                </div>   
                            </div>
                        </div>   
                    </div>

                    <div class="pb-8">
                        <div class="flex">
                            <div class="text-3xl tracking-wider text-gray-400">03</div>
                            <div class="mt-2 pl-2">
                                <div class="text-lg inline-block">News Needs to Meet Its Audiences Where They Are</div>  
                                 <div class="text-sm inline-block pt-2">
                                    <span>{{post.user.name}}</span>&nbsp;<span class="text-gray-500 text-sm">in</span>&nbsp;<span class="text-sm">{{post.category.category_name}}</span>
                                </div>   
                            </div>
                        </div>   
                    </div>

                    <div class="pb-8">
                        <div class="flex">
                            <div class="text-3xl tracking-wider text-gray-400">04</div>
                            <div class="mt-2 pl-2">
                                <div class="text-lg inline-block">News Needs to Meet Its Audiences Where They Are</div>  
                                 <div class="text-sm inline-block pt-2">
                                    <span>{{post.user.name}}</span>&nbsp;<span class="text-gray-500 text-sm">in</span>&nbsp;<span class="text-sm">{{post.category.category_name}}</span>
                                </div>   
                            </div>
                        </div>   
                    </div>
                    <p class="pb-8 text-green-400 uppercase tracking-wide text-xs font-bold">SEE ALL POPULAR ></p>

                </div>
            </div>
        </layout>

    </div>
</template>

<script>
import Layout from "@/Shared/Layout";
import Avatar from "@/Shared/tuis/Avatar";
import TextareaInput from "@/Shared/tuis/TextareaInput";
import LoadingButton from "@/Shared/tuis/LoadingButton";
import TextInput from "@/Shared/tuis/TextInput";


    export default {
        components: {
            Layout,
            Avatar,
            TextareaInput,
            LoadingButton,
            TextInput
        },
        data () {
            return {
                form: {
                    comment: ""
                },
                subform: {
                    subcomment: ""
                }
            }
        },
        props: [
            "post", "errors", "commentDatas"
        ],
        methods: {
            commentCreate () {
			    this.$refs.submitButton.startLoading();

                this.$inertia.post(`/post/${this.post.id}/comment`, this.form)
                .then(res=>{
                    this.$refs.submitButton.stopLoading();
                    this.form.comment = "";
					// this.form = {};
                }).catch({

                });
            },

            subCommentCreate (commentId) {
			    // this.$refs.submitButton.startLoading();

                this.$inertia.post(`/post/${this.post.id}/${commentId}/comment`, this.subform)
                .then(res=>{
                    // this.$refs.submitButton.stopLoading();
                    this.subform.subcomment = "";
					// this.form = {};
                }).catch({

                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>