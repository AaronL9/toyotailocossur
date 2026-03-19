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
  inquiry_no: z.string(),
  inquiry_milage: z.nullable(z.string()),
  inquiry_plateno: z.nullable(z.string()),
  inquiry_name: z.nullable(z.string()),
  inquiry_contact: z.nullable(z.string()),
  inquiry_email: z.nullable(z.string()),
  inquiry_date: z.nullable(z.string()),
  inquiry_appointment_date: z.nullable(z.string()),
  inquiry_appointment_time: z.nullable(z.string())
});

const InquiryIndexApiSchema = z.object({
  pagination: PaginationSchema,
  inquiries: z.array(InquirySchema),
});

type Pagination = z.infer<typeof PaginationSchema>;
type Inquiry = z.infer<typeof InquirySchema>;
type InquiryIndexApi = z.infer<typeof InquiryIndexApiSchema>;

export default function InquiryPage() {
  console.log('hello world');
  Alpine.data('InquiryTable', () => ({
    pagination: {
      total: 0,
      currentPage: 0,
      pageCount: 0,
      next: null,
      previous: null,
    } as Pagination,
    data: [] as Inquiry[],
    loading: false,

    async init(uri = '/api/inquiry') {
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

      const uri = new URL("/api/inquiry", location.origin);
      uri.searchParams.append("search", target.value);

      this.init(uri.toString());
    },
  }));
}