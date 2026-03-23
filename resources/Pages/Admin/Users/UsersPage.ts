import * as z from "zod";

const UsersApi = z.object({
  pagination: z.object({
    total: z.number(),
    currentPage: z.number(),
    pageCount: z.number(),
    next: z.nullable(z.string()),
    previous: z.nullable(z.string()),
  }),
  users: z.array(z.object({
    user_no: z.string(),
    user_fname: z.string(),
    user_lname: z.string(),
    user_uname: z.string(),
    user_mname: z.nullable(z.string())
  }))
})

type UsersArray = z.infer<typeof UsersApi>["users"];
type pagination = z.infer<typeof UsersApi>["pagination"];

export default function UsersPage() {
  Alpine.data('UsersPage', () => ({
    users: [] as UsersArray,
    pagination: {
      total: 0,
      currentPage: 0,
      pageCount: 0,
      next: null,
      previous: null,
    } as pagination,
    loading: true,

    async init(uri = "/api/users") {
      const response = await fetch(uri);
      const result = await UsersApi.safeParseAsync(await response.json());

      if (!result.success) {
        console.log(result.error);
      } else {
        this.users = result.data.users;
        this.pagination = result.data.pagination;
        this.loading = false
      }
    },

    async next(e: Event) {
      const btn = e.currentTarget;

      if (!(btn instanceof HTMLButtonElement)) return;

      this.loading = true;
      this.init(btn.dataset.uri);
    },

    async prev(e: Event) {
      const btn = e.currentTarget;

      if (!(btn instanceof HTMLButtonElement)) return;

      this.loading = true;
      this.init(btn.dataset.uri);
    },

    async search(e: Event) {
      this.loading = true;

      const target = e.currentTarget;

      if (!(target instanceof HTMLInputElement)) return;

      const uri = new URL("/api/users", location.origin);
      uri.searchParams.append("search", target.value);

      this.init(uri.toString());
    }
  }));
}