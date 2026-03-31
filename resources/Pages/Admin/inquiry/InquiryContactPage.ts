import axios from "axios";
import * as z from "zod";

const PaginationSchema = z.object({
  total: z.number(),
  currentPage: z.number(),
  pageCount: z.number(),
  next: z.nullable(z.string()),
  previous: z.nullable(z.string()),
});

const InquirySchema = z.object({
  id: z.string(),
  inquirer: z.nullable(z.string()),
  contact: z.nullable(z.string()),
  email: z.nullable(z.string()),
  message: z.nullable(z.string()),
  date: z.string(),
});

const InquiryIndexApiSchema = z.object({
  pagination: PaginationSchema,
  inquiries: z.array(InquirySchema),
});

type Pagination = z.infer<typeof PaginationSchema>;
type Inquiry = z.infer<typeof InquirySchema>;

export default function InquiryContactPage() {
  Alpine.data('InquiryContactTable', () => ({
    pagination: {
      total: 0,
      currentPage: 0,
      pageCount: 0,
      next: null,
      previous: null,
    } as Pagination,
    data: [] as Inquiry[],
    loading: false,

    async init(uri = '/api/inquiry?type=contact') {

      try {
        const response = await axios.get(uri);

        const result = InquiryIndexApiSchema.safeParse(response.data);

        if (!result.success) {
          console.log(result.error);
        } else {
          this.data = result.data.inquiries;
          this.pagination = result.data.pagination;
          this.loading = false
        }

        console.log(response);
      } catch (error) {
        console.error(error);
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

      const uri = new URL("/api/inquiry?type=contact", location.origin);
      uri.searchParams.append("search", target.value);

      this.init(uri.toString());
    },
  }));
}