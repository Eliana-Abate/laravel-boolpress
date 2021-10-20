<template>
  <section id="post-list">
    <h2>Elenco dei post</h2>
    <Pagination
      :currentPage="pagination.currentPage"
      :lastPage="pagination.lastPage"
      @onPageChange="changePage"
    />
    <PostCard v-for="post in posts" :key="post.id" :post="post" />
  </section>
</template>

<script>
import PostCard from "./PostCard.vue";
import Pagination from "../Pagination.vue";
export default {
  name: "PostList",
  components: {
    PostCard,
    Pagination,
  },

  data() {
    return {
      posts: [],
      pagination: {},
    };
  },
  methods: {
    //recupero i posts dall'indirizzo locale
    getPosts(page) {
      axios
        .get(`http://localhost:8000/api/posts?page=${page}`)
        .then((res) => {
          //DESTRUCTURING AFTER PAGINATION
          const { data, current_page, last_page } = res.data;
          this.posts = data;
          this.pagination = {
            currentPage: current_page,
            lastPage: last_page,
          };
        })
        .catch((err) => {
          console.error(err);
        });
    },
    changePage(page) {
      this.getPosts(page);
    },
  },
  created() {
    this.getPosts();
  },
};
</script>

<style>
</style>