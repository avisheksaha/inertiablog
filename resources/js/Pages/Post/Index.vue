<template>
	<layout>
		<div class="flex items-center mb-6">
			<heading size="heading" class="mr-3">All Posts</heading>
			<loading-button size="small" @click="redirect('posts/create')">&plus; Create Post</loading-button>
		</div>
		<card :is-padding="false">
			<template v-if="posts.length > 0">
				<basic-table :headings="tableHeadings">
					<tr
						v-for="(post, postIndex) in posts"
						:key="postIndex"
						class="hover:bg-grey-lightest focus-within:bg-grey-lightest"
					>
						<td class="border-t">
							<span class="text-gray-700 px-6 py-4 flex items-center focus:text-indigo">{{ post.title }}</span>
						</td>

						<td class="border-t">
							<span
								class="text-gray-700 px-6 py-4 flex items-center focus:text-indigo"
							>{{ post.user.name }}</span>
						</td>

						<td class="border-t">
							<span
								class="text-gray-700 px-6 py-4 flex items-center focus:text-indigo"
							>{{ post.category.category_name }}</span>
						</td>
						<td class="border-t">
							<span
								class="text-gray-700 px-6 py-4 flex items-center focus:text-indigo"
							>{{ post.publish_at_formated }}</span>
						</td>
						<td class="border-t">
							<switch-input color="#F5BF21" v-model="post.status" @toggle="publishPost(post.id)">
							</switch-input>
							<!-- <badge variant="warning">{{post.status == 0 ? "Pending" : ""}}</badge> -->
							<!-- <badge variant="warning" v-if="post.status == 0">{{post.status == 0 ? "Pending" : ""}}</badge>
							<badge variant="success" v-if="post.status == 1">{{post.status == 1 ? "Approved" : ""}}</badge> -->
						</td>

						<td class="border-t text-center">
							<inertia-link :href="`posts/${post.id}/edit`" class="text-blue-600 mr-3">Edit</inertia-link>
							<inertia-link href="#" @click.prevent="showModal(post.id)" class="text-red-600">Delete</inertia-link>
							<!-- <inertia-link :href="`posts/${post.id}/publish`" @click.prevent="showModalPublish(post.id)" class="text-blue-600 mr-3">Publish</inertia-link> -->
						</td>
					</tr>
				</basic-table>
			</template>
			<template v-else>
				<div class="py-16 px-4 text-center">
					<heading class="mb-4">No post available here</heading>
					<loading-button @click="redirect('posts/create')">&plus; Create Post</loading-button>
				</div>
			</template>
		</card>
		<div class>
			<div
				class="absolute w-ful h-full top-0 bottom-0 left-0 right-0"
				v-if="openModal"
				@click="openModal=false"
			>
				<card with-footer class="shadow-lg max-w-lg mx-auto opacity-100 mt-20">
					<heading size="heading" class="mb-4">Confirm Delete ?</heading>
					<heading>Once deleted can't be retrive back</heading>
					<template #footer>
						<loading-button
							variant="secondary"
							variant-type="outline"
							type="button"
							@click="openModal=false"
						>Cancel</loading-button>
						<loading-button ref="deleteButton" @click="deletePost">Yes, Delete</loading-button>
					</template>
				</card>
			</div>

			<!-- <div class="absolute w-ful h-full top-0 bottom-0 left-0 right-0"
				v-if="openModalPublish"
				@click="openModalPublish=false">

				<card with-footer class="shadow-lg max-w-lg mx-auto opacity-100 mt-20">
					<heading size="heading" class="mb-4">Confirm PUBLISH ?</heading>
					<heading>Read before you Publish</heading>
					<template #footer>
						<loading-button
							variant="secondary"
							variant-type="outline"
							type="button"
							@click="openModalPublish=false"
						>Cancel</loading-button>
						<loading-button ref="publishButton" @click="publishPost">Yes, Publish</loading-button>
					</template>
				</card>
			</div> -->
		</div>
	</layout>
</template>
<script>
import Layout from "@/Shared/Layout";
import Card from "@/Shared/tuis/Card";
import Heading from "@/Shared/tuis/Heading";
import Badge from "@/Shared/tuis/Badge";
import BasicTable from "@/Shared/tuis/BasicTable";
import LoadingButton from "@/Shared/tuis/LoadingButton";
import SwitchInput from "@/Shared/tuis/SwitchInput";

export default {
	components: {
		Layout,
		Card,
		BasicTable,
		Heading,
		LoadingButton,
		Badge,
		SwitchInput
	},
	props: ["posts"],
	data() {
		return {
			// switchInput: false,

			openModal: false,
			deletePostId: null,
			openModalPublish: false,
			publishPostId: null,
			

			tableHeadings: [
				{
					title: "Title",
					align: "left",
					type: "text"
				},
				{
					title: "Created By",
					align: "left",
					type: "text"
				},
				{
					title: "Category",
					align: "left",
					type: "text"
				},
				{
					title: "Publish At",
					align: "left",
					type: "text"
				},
				{
					title: "Status",
					align: "left",
					type: "text"
				},
				{
					title: "Action",
					align: "center",
					type: "text"
				}
			]
		};
	},
	methods: {
		showModal(id) {
			this.openModal = !this.openModal;
			this.deletePostId = null;
			this.deletePostId = id;
		},
		// showModalPublish(id) {
		// 	this.openModalPublish = !this.openModalPublish;
		// 	this.publishPostId = null;
		// 	this.publishPostId = id;
		// },

		redirect(url) {
			location.replace(url);
		},

		deletePost(post) {
			// var result = confirm("Are you sure?");
			// if (result == true) {
			// 	this.$inertia
			// 		.delete(`/posts/${post}/delete`)
			// 		.then(res => {})
			// 		.catch();
			// } else {
			// 	return;
			// }
			this.$refs.deleteButton.startLoading();

			this.$inertia
				.delete(`/posts/${this.deletePostId}/delete`)
				.then(res => {
					this.$refs.deleteButton.stoptLoading();
				})
				.catch(() => {
					this.$refs.deleteButton.stopLoading();
				});
		},

		publishPost(post) {
			// this.$refs.publishButton.startLoading();

			this.$inertia
				.post(`/post/${post}/publish`)
				.then(res => {
					// this.$refs.publishButton.stoptLoading();
				})
				.catch(() => {
					// this.$refs.publishButton.stopLoading();
				});
		}
	}
};
</script>