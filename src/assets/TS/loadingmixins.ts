import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default {
  methods: {
    async loadDataWithLoadingIndicator(fetchData: () => Promise<unknown>) {
      const store = useStore();
      const router = useRouter();

      store.commit("setLoading", true);

      const timeout = setTimeout(() => {
        if (store.state.isLoading) {
          router.push("/pause");
        }
      }, 5000);

      await fetchData();

      clearTimeout(timeout);
      store.commit("setLoading", false);
    },
  },
};
