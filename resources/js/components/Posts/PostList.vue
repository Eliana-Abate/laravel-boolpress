<template>
  <section id="post-list">
    <h2>Elenco dei post</h2>
    <PostCard />
  </section>
</template>

<script>
import PostCard from "./PostCard.vue";
export default {
  name: "PostList",
  components: {
    PostCard,
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
          this.posts = res.data;
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