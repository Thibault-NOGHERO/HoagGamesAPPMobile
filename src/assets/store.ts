import { createStore } from "vuex";

const store = createStore({
  state: {
    isLoading: false,
  },
  mutations: {
    setLoading(state, isLoading) {
      state.isLoading = isLoading;
    },
  },
});

export default store;
