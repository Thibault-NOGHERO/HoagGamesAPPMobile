declare interface ImportMeta {
  env: {
    [key: string]: string | undefined;
    VUE_APP_API_URL: string;
    VUE_APP_PUBLIC_PATH;
  };
}
