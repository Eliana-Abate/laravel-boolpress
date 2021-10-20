<template>
  <section id="post-list">
    <h2>Elenco dei post</h2>
    <Pagination />
    <PostCard v-for="post in posts" :key="post.id" :post="post" />
  </section>
</template>

<script>
import PostCard from "./PostCard.vue";
import Pagination from "..Pagination.vue";
export default {
  name: "PostList",
  components: {
    PostCard,
    Pagination,
  },

  data() {
    return { posts: [] };
  },
  methods: {
    //recupero i posts dall'indirizzo locale
    getPosts() {
      axios
        .get("http://localhost:8000/api/posts")
        .then((res) => {
          //DESTRUCTURING AFTER PAGINATION
          const { data, current_page, last_page } = res.data;
          this.posts = data;
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
  created() {
    this.getPosts();
  },
};
</script>

<style>
</style>